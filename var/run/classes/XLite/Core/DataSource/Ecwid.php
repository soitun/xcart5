<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * X-Cart
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the software license agreement
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.x-cart.com/license-agreement.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to licensing@x-cart.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not modify this file if you wish to upgrade X-Cart to newer versions
 * in the future. If you wish to customize X-Cart for your needs please
 * refer to http://www.x-cart.com/ for more information.
 *
 * @category  X-Cart 5
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

namespace XLite\Core\DataSource;

/**
 * Ecwid data source
 */
class Ecwid extends ADataSource
{
    /**
     * How long can make a request to Ecwid API (seconds).
     */
    const RATE_LIMIT = 0.36;

    /**
     * Temporary vaiable name 
     */
    const TMP_VAR_NAME = 'ecwid_datasource_last_time';

    /**
     * Get Ecwid data source name
     *
     * @return string
     */
    public static function getName()
    {
        return 'Ecwid';
    }

    /**
     * Get Ecwid data source name
     *
     * @return string
     */
    public static function getType()
    {
        return \XLite\Model\DataSource::TYPE_ECWID;
    }

    /**
     * Get standardized data source information array
     * 
     * @return array
     */
    public function getInfo()
    {
        return $this->callApi('profile');
    }

    /**
     * Checks whether the data source is valid
     * 
     * @return boolean
     */
    public function isValid()
    {
        $result = false;

        if (0 < $this->getStoreId()) {

            try {
                $result = (bool)$this->callApi('profile');

            } catch(\Exception $e) {
            }
        }

        return $result;
    }

    /**
     * Request and return products collection
     * 
     * @return \XLite\Core\DataSource\Ecwid\Products
     */
    public function getProductsCollection()
    {
        return new \XLite\Core\DataSource\Ecwid\Products($this);
    }

    /**
     * Request and return categories collection
     * 
     * @return \XLite\Core\DataSource\Ecwid\Categories
     */
    public function getCategoriesCollection()
    {
        return new \XLite\Core\DataSource\Ecwid\Categories($this);
    }

    /**
     * Get Ecwid Store ID
     * 
     * @return integer
     */
    public function getStoreId()
    {
        return $this->getConfiguration()->getParameterValue('storeid');
    }

    /**
     * Does an Ecwid API call
     * 
     * @param string $apiMethod API method name to call
     * @param string $params    Parameters to pass along OPTIONAL
     *  
     * @return array
     * @throws Exception
     */
    public function callApi($apiMethod, $params = array())
    {
        $time = microtime(true);
        $lastTime = \XLite\Core\Database::getRepo('XLite\Model\TmpVar')->getVar(static::TMP_VAR_NAME);

        if ($lastTime && $lastTime + static::RATE_LIMIT > $time) {
            $delay = ($lastTime + static::RATE_LIMIT) - $time;
            usleep(round($delay * 1000000));
        }

        $url = 'http://app.ecwid.com/api/v1/'
            . $this->getStoreId() . '/'
            . $apiMethod
            . ($params ? ('?' . http_build_query($params)) : '');

        $bouncer = new \XLite\Core\HTTP\Request($url);

        $bouncer->requestTimeout = 60;
        $response = $bouncer->sendRequest();

        $result = null;

        \XLite\Core\Database::getRepo('XLite\Model\TmpVar')->setVar(static::TMP_VAR_NAME, microtime(true));

        if (200 == $response->code) {
            $result = json_decode($response->body, true);

        } else {
            throw new \Exception('Call to \'' . $url . '\' failed with \'' . $response->code . '\' code');
        }

        return $result;
    }

    /**
     * Performs batch api call
     * Takes an array of parameters in the following form:
     * array (
     *     'product_33' => array (
     *         'method' => 'product',
     *         'params' => array('id' => 33)
     *     ),
     *     'product_34' => array (
     *         'method' => 'product',
     *         'params' => array('id' => 34)
     *     )
     * )
     * Returns an array containing keys specified in the input along with results for each call
     * 
     * @param array $params An array of call parameters
     *  
     * @return array
     */
    public function callBatchApi(array $params)
    {
        $queries = array();

        foreach ($params as $key => $param) {
            $queryParams = array();
            foreach ($param['params'] as $k => $v) {
                $queryParams[] = $k . '=' . $v;
            }

            $queries[$key] = $param['method'] . '?' . implode('&', $queryParams);
        }

        return $this->callApi('batch', $queries);
    }
}
