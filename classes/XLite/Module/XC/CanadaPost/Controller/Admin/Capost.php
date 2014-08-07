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
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

namespace XLite\Module\XC\CanadaPost\Controller\Admin;

/**
 * CanadaPost settings page controller
 *
 */
class Capost extends \XLite\Controller\Admin\ShippingSettings
{
    /**
     * Return the current page title (for the content area)
     *
     * @return string
     */
    public function getTitle()
    {
        return 'CanadaPost settings';
    }

    /**
     * getOptionsCategory
     *
     * @return string
     */
    protected function getOptionsCategory()
    {
        return 'XC\CanadaPost';
    }

    /**
     * Do action "Enable merchant registration wizard"
     *
     * @return void
     */
    public function doActionEnableWizard()
    {
        $optionsMap = array(
            'customer_number' => '',
            'contract_id'     => '',
            'user'            => '',
            'password'        => '',
            'quote_type'      => \XLite\Module\XC\CanadaPost\Core\API::QUOTE_TYPE_CONTRACTED,
            'wizard_hash'     => '',
            'wizard_enabled'  => 'Y',
            'developer_mode'  => 'N',
        );
 
        $options = \XLite\Core\Database::getRepo('\XLite\Model\Config')
            ->findBy(array('category' => 'XC\CanadaPost', 'name' => array_keys($optionsMap)));

        foreach ($options as $k => $o) {

            $o->setValue($optionsMap[$o->getName()]);

            \XLite\Core\Database::getEM()->persist($o);
        }

        \XLite\Core\Database::getEM()->flush();

        $this->setReturnURL($this->buildURL('capost'));
    }

    /**
     * Do action 'Update'
     *
     * @return void
     */
    public function doActionUpdate()
    {
        $postedData = \XLite\Core\Request::getInstance()->getData();
        $options    = \XLite\Core\Database::getRepo('\XLite\Model\Config')->findBy(array('category' => $this->getOptionsCategory()));
        $isUpdated  = false;

        foreach ($options as $key => $option) {
            $name = $option->getName();
            $type = $option->getType();

            if (isset($postedData[$name]) || 'checkbox' == $type) {
                if ('checkbox' == $type) {
                    $option->setValue((isset($postedData[$name]) && $postedData[$name]) ? 'Y' : 'N');

                } else {
                    $option->setValue($postedData[$name]);
                }

                $isUpdated = true;
                \XLite\Core\Database::getEM()->persist($option);
            }
        }

        if ($isUpdated) {
            \XLite\Core\Database::getEM()->flush();
        }
    }

    /**
     * Get shipping processor
     *
     * @return object
     */
    protected function getProcessor()
    {
        return new \XLite\Module\XC\CanadaPost\Model\Shipping\Processor\CanadaPost();
    }

    /**
     * Get schema of an array for test rates routine
     *
     * @return array
     */
    protected function getTestRatesSchema()
    {
        $schema = parent::getTestRatesSchema();

        foreach (array('srcAddress', 'dstAddress') as $k) {
            unset($schema[$k]['city']);
            unset($schema[$k]['state']);
        }

        return $schema;
    }

    /**
     * Get input data to calculate test rates
     *
     * @param array $schema  Input data schema
     * @param array &$errors Array of fields which are not set
     *
     * @return array
     */
    protected function getTestRatesData(array $schema, &$errors)
    {
        $package = parent::getTestRatesData($schema, $errors);

        $package['srcAddress']['country'] = 'CA';

        $data = array(
            'packages' => array($package),
        );

        return $data;
    }
}
