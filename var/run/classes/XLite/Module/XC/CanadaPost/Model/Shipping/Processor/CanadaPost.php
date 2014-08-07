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

namespace XLite\Module\XC\CanadaPost\Model\Shipping\Processor;

/**
 * Shipping processor model
 * API documentation: https://www.canadapost.ca/cpo/mc/business/productsservices/developers/services/rating/default.jsf
 *
 */
class CanadaPost extends \XLite\Model\Shipping\Processor\AProcessor
{
    /**
     * $newMethods is used to prevent duplicating methods in database 
     * 
     * @var array
     */
    protected $newMethods = array();

    /**
     * Unique processor Id
     *
     * @var string
     */
    protected $processorId = 'capost';

    /**
     * getProcessorName
     *
     * @return string
     */
    public function getProcessorName()
    {
        return 'Canada Post';
    }

    /**
     * Disable the possibility to edit the names of shipping methods in the interface of administrator
     *
     * @return boolean
     */
    public function isMethodNamesAdjustable()
    {
        return false;
    }

    /**
     * Returns shipping rates
     *
     * @param array|\XLite\Logic\Order\Modifier\Shipping $inputData   Shipping order modifier or array of data for request
     * @param boolean                                    $ignoreCache Flag: if true then do not get rates from cache OPTIONAL
     *
     * @return array
     */
    public function getRates($inputData, $ignoreCache = false)
    {
        $this->errorMsg = null;
        $rates = array();

        if ($this->isConfigured()) {
            $data = $this->prepareInputData($inputData);
        }

        if (!empty($data)) {

            // Calculate rates
            $rates = $this->getAssembledRates($data, $ignoreCache);

        } else {

            $this->errorMsg = 'Canada Post module is not configured or origin country is not Canada';
        }

        return $rates;
    }

    /**
     * Returns assembled shipping rates
     *
     * @param array|\XLite\Logic\Order\Modifier\Shipping $inputData   Shipping order modifier or array of data for request
     * @param boolean                                    $ignoreCache Flag: if true then do not get rates from cache OPTIONAL
     *
     * @return array
     */
    protected function getAssembledRates($data, $ignoreCache)
    {
        $rates = array();
        $codeCounter = array();

        foreach ($data['packages'] as $pid => $package) {

            // Perform request for rates for each package
            $packageRates = $this->doQuery($package, $ignoreCache);

            if (!empty($packageRates)) {

                // Assemble package rates to the single rates array

                foreach ($packageRates as $code => $rate) {

                    if (!isset($rates[$code])) {
                        $rates[$code] = $rate;
                        $codeCounter[$code] = 1;

                    } else {
                        $rates[$code]->setBaseRate($rates[$code]->getBaseRate() + $rate->getBaseRate());
                        $codeCounter[$code] ++;
                    }
                }

            } else {
                $rates = array();
                break;
            }
        }

        if ($rates) {

            // Exclude rates for methods which are not available for all packages

            foreach ($codeCounter as $code => $cnt) {
                if (count($data['packages']) != $cnt) {
                    unset($rates[$code]);
                }
            }
        }

        return $rates;
    }

    /**
     * Returns true if CanadaPost module is configured
     *
     * @return boolean
     */
    protected function isConfigured()
    {
        return !empty(\XLite\Core\Config::getInstance()->XC->CanadaPost->user)
            && !empty(\XLite\Core\Config::getInstance()->XC->CanadaPost->password)
            && (
                !empty(\XLite\Core\Config::getInstance()->XC->CanadaPost->customer_number)
                || \XLite\Module\XC\CanadaPost\Core\API::QUOTE_TYPE_NON_CONTRACTED == \XLite\Core\Config::getInstance()->XC->CanadaPost->quote_type
            );
    }

    /**
     * Get package limits
     *
     * @return array
     */
    protected function getPackageLimits()
    {
        $limits = parent::getPackageLimits();

        $config = $this->getConfig();

        // Weight in store weight units
        $limits['weight'] = \XLite\Core\Converter::convertWeightUnits(
            $config->max_weight,
            'kg',
            \XLite\Core\Config::getInstance()->Units->weight_unit
        );

        $limits['length'] = $config->length;
        $limits['width']  = $config->width;
        $limits['height'] = $config->height;

        return $limits;
    }

    /**
     * Returns array of data for request
     *
     * @param array|\XLite\Logic\Order\Modifier\Shipping $inputData Array of input data or a shipping order modifier
     *
     * @return array
     */
    protected function prepareInputData($inputData)
    {
        $data = array();
        $commonData = array();

        if ($inputData instanceOf \XLite\Logic\Order\Modifier\Shipping) {

            if ('CA' == \XLite\Core\Config::getInstance()->Company->location_country) {

                $commonData['srcAddress'] = array(
                    'zipcode' => \XLite\Core\Config::getInstance()->Company->location_zipcode,
                );
            }

            $commonData['dstAddress'] = \XLite\Model\Shipping::getInstance()->getDestinationAddress($inputData);

            if (!empty($commonData['srcAddress']) && !empty($commonData['dstAddress'])) {
                $data['packages'] = $this->getPackages($inputData);
            }

        } else {
            $data = $inputData;
        }

        if (!empty($data['packages'])) {

            foreach ($data['packages'] as $key => $package) {

                $package = array_merge($package, $commonData);

                $package['weight'] = \XLite\Core\Converter::convertWeightUnits(
                    $package['weight'],
                    \XLite\Core\Config::getInstance()->Units->weight_unit,
                    'kg'
                );
                
                $package['subtotal'] = \XLite\Module\XC\CanadaPost\Core\API::applyConversionRate($package['subtotal']);

                $data['packages'][$key] = $package;
            }

        } else {
            $data = array();
        }

        return $data;
    }

    /**
     * doQuery
     *
     * lowlevel query
     *
     * @param mixed   $data        Array of prepared package data
     * @param boolean $ignoreCache Flag: if true then do not get rates from cache
     *
     * @return void
     */
    protected function doQuery($data, $ignoreCache)
    {
        $rates = array();

        $availableMethods = \XLite\Core\Database::getRepo('XLite\Model\Shipping\Method')
            ->findMethodsByProcessor($this->getProcessorId());

        $config = $this->getConfig();

        $XMLData = $this->getXMLData($data);

        try {

            if (!$ignoreCache) {
                $cachedRates = $this->getDataFromCache($XMLData);
            }

            if (isset($cachedRates)) {
                $result = $cachedRates;

            } else {
                $postURL = \XLite\Module\XC\CanadaPost\Core\API::getInstance()->getGetRatesEndpoint();

                $bouncer = new \XLite\Core\HTTP\Request($postURL);
                $bouncer->requestTimeout = 5;
                $bouncer->body = $XMLData;
                $bouncer->verb = 'POST';
                $bouncer->setHeader('Authorization', 'Basic ' . base64_encode($config->user . ':' . $config->password));
                $bouncer->setHeader('Accept', 'application/vnd.cpc.ship.rate-v2+xml');
                $bouncer->setHeader('Content-Type', 'application/vnd.cpc.ship.rate-v2+xml');
                $bouncer->setHeader('Accept-language', \XLite\Module\XC\CanadaPost\Core\API::ACCEPT_LANGUAGE_EN);
                
                if (\XLite\Module\XC\CanadaPost\Core\API::isOnBehalfOfAMerchant()) {
                    $bouncer->setHeader('Platform-id', \XLite\Module\XC\CanadaPost\Core\API::getInstance()->getPlatformId());
                }

                $response = $bouncer->sendRequest();

                $result = $response->body;

                if (200 == $response->code) {
                    $this->saveDataInCache($XMLData, $result);
                
                } else {
                    $this->errorMsg = sprintf('Error while connecting to the Canada Post host (%s)', $postURL);
                }

                if (\XLite\Core\Config::getInstance()->XC->CanadaPost->debug_enabled) {
                    // Save debug log
                    \XLite\Module\XC\CanadaPost\Core\API::logApiCall($postURL, 'Get Rates', $XMLData, $result);
                }
            }

            // Save communication log for test request only (ignoreCache is set for test requests only)

            if ($ignoreCache === true) {
                $this->apiCommunicationLog[] = array(
                    'post URL' => $postURL,
                    'request'  => htmlentities($XMLData),
                    'response' => htmlentities(\XLite\Core\XML::getInstance()->getFormattedXML($result))
                );
            }

            $response = $this->parseResponse($result);

            if (!isset($this->errorMsg) && !isset($response['err_msg']) && !empty($response['services'])) {

                $conversionRate = \XLite\Module\XC\CanadaPost\Core\API::getCurrencyConversionRate();

                foreach ($response['services'] as $service) {
                    
                    $rate = new \XLite\Model\Shipping\Rate();

                    $method = $this->getShippingMethod($service['service_code'], $availableMethods);

                    if (!isset($method)) {
                        // Unknown method received: add this to the database with disabled status
                        $this->addShippingMethod($service);

                    } elseif ($method->getEnabled()) {
                        // Method is registered and enabled

                        $rate->setMethod($method);
                        $rate->setBaseRate($service['rate'] * $conversionRate);

                        $rates[$service['service_code']] = $rate;
                    }
                }

            } elseif (!isset($this->errorMsg) || isset($response['err_msg'])) {
                $this->errorMsg = (isset($response['err_msg']) ? $response['err_msg'] : ($this->errorMsg ?: 'Unknown error'));
            }

        } catch (\Exception $e) {

            $this->errorMsg = $e->getMessage();
        }

        return $rates;
    }

    /**
     * parses response and returns an associative array
     *
     * @param string $stringData XML response of capost api
     *
     * @return array
     */
    protected function parseResponse($stringData)
    {
        $result = array();

        $xml = \XLite\Core\XML::getInstance();

        $xmlParsed = $xml->parse($stringData, $err);

        if (isset($xmlParsed['messages'])) {
            $result['err_msg'] = $xml->getArrayByPath($xmlParsed, 'messages/message/description/0/#');
        }

        if (!isset($result['err_msg'])) {

            $services = $xml->getArrayByPath($xmlParsed, 'price-quotes/price-quote');

            if ($services) {
                foreach ($services as $k => $v) {

                    $result['services'][] = array(
                        'service_code' => $xml->getArrayByPath($v, 'service-code/0/#'),
                        'service_name' => $xml->getArrayByPath($v, 'service-name/0/#'),
                        'rate' => $xml->getArrayByPath($v, 'price-details/0/#/due/0/#'),
                    );
                }
            }
        }

        return $result;
    }

    /**
     * Generate XML request
     *
     * @param array $data Array of package data
     *
     * @return string
     */
    protected function getXMLData($data)
    {
        $config = $this->getConfig();

        $xmlHeader = '<?xml version="1.0" encoding="utf-8"?'.'>';
        
        //  Option applies to this shipment.
        $opts = array();

        if (
            $config->coverage > 0
            && $data['subtotal'] > 0
        ) {
            // Add coverage (insuarance) option

            if ($config->coverage != 100) {
                $data['subtotal'] = $data['subtotal'] / 100 * $config->coverage;
            }

            $coverage = \XLite\Module\XC\CanadaPost\Core\API::adjustFloatValue($data['subtotal'], 2, 0.01, 99999.99);

            $opts[] = <<<OUT
    <option>
        <option-code>COV</option-code>
        <option-amount>{$coverage}</option-amount>
    </option>
OUT;
        }

        $optionsXML = '';

        if ($opts) {
            $options = implode(PHP_EOL, $opts);
            $optionsXML = <<<OUT
<options>
$options
</options>
OUT;
        }

        $contractId = '';
        $customerNumber = '';
        if (\XLite\Module\XC\CanadaPost\Core\API::QUOTE_TYPE_CONTRACTED == $config->quote_type) {
            $customerNumber = <<<OUT
<customer-number>{$config->customer_number}</customer-number>
OUT;
            if ($config->contract_id) {
                $contractId = <<<OUT
<contract-id>{$config->contract_id}</contract-id>
OUT;
            }
        }

        $parcelCharacteristics = '';

        $data['weight'] = \XLite\Module\XC\CanadaPost\Core\API::adjustFloatValue($data['weight'], 3, 0.001, 99.999);

        $weight = <<<OUT
<weight>{$data['weight']}</weight>
OUT;

        $dimensions = '';

        if (!empty($data['box'])) {
            $length = $data['box']['length'];
            $width  = $data['box']['width'];
            $height = $data['box']['height'];

        } elseif ($config->length && $config->width && $config->height) {
            $length = $config->length;
            $width  = $config->width;
            $height = $config->height;
        }

        if (!empty($length) && !empty($width) && !empty($height)) {

            $length = \XLite\Module\XC\CanadaPost\Core\API::adjustFloatValue($length, 1, 0.1, 999.9);
            $width  = \XLite\Module\XC\CanadaPost\Core\API::adjustFloatValue($width, 1, 0.1, 999.9);
            $height = \XLite\Module\XC\CanadaPost\Core\API::adjustFloatValue($height, 1, 0.1, 999.9);

            $dimensions =<<<OUT
<dimensions>
    <length>{$length}</length>
    <width>{$width}</width>  
    <height>{$height}</height>
</dimensions>
OUT;
        }
        $parcelCharacteristics .= <<<OUT
<parcel-characteristics>
    {$weight}
    {$dimensions}
</parcel-characteristics>
OUT;

        $destination = '';

        $dstPostalCode = \XLite\Module\XC\CanadaPost\Core\API::strToUpper(
            preg_replace('/\s+/', '', $data['dstAddress']['zipcode'])
        );

        $srcPostalCode = \XLite\Module\XC\CanadaPost\Core\API::strToUpper(
            preg_replace('/\s+/', '', $data['srcAddress']['zipcode'])
        );

        if ('CA' == $data['dstAddress']['country']) {
            $destination = <<<OUT
<domestic>
    <postal-code>{$dstPostalCode}</postal-code>
</domestic>
OUT;

        } elseif ('US' == $data['dstAddress']['country']) {
            $destination = <<<OUT
<united-states>
    <zip-code>{$dstPostalCode}</zip-code>
</united-states>
OUT;

        } else {
            $destination = <<<OUT
<international>
    <country-code>{$data['dstAddress']['country']}</country-code>
</international>
OUT;
        }
        
        $quoteType = (\XLite\Module\XC\CanadaPost\Core\API::QUOTE_TYPE_CONTRACTED == $config->quote_type) ? 'commercial' : 'counter';

        $request = <<<OUT
{$xmlHeader}
<mailing-scenario xmlns="http://www.canadapost.ca/ws/ship/rate-v2">
    {$customerNumber}
    <quote-type>{$quoteType}</quote-type>
    {$optionsXML}
    {$contractId}
    {$parcelCharacteristics}
    <origin-postal-code>{$srcPostalCode}</origin-postal-code>
    <destination>{$destination}</destination>
</mailing-scenario>
OUT;

        return $request;
    }

    /**
     * Get CanadaPost options object
     *
     * @return \XLite\Core\CommonCell
     */
    protected function getConfig()
    {
        return \XLite\Module\XC\CanadaPost\Core\API::getCanadaPostConfig();
    }

    /**
     * Get shipping method by method code
     * 
     * @param string method code
     * @param array available methods
     *
     * @return XLite\Model\Shipping\Method
     */
    protected function getShippingMethod($code, $availableMethods)
    {
        $result = null;

        // Check if method with $code exists in $availableMethods
        if (!empty($availableMethods) && is_array($availableMethods)) {

            foreach ($availableMethods as $method) {

                if ($method->getCode() == $code) {
                    $result = $method;
                    break;
                }
            }
        }

        // If not found - check if this method available in database
        if (!isset($result)) {
            $result = \XLite\Core\Database::getRepo('XLite\Model\Shipping\Method')->findOneByCode($code);
        }

        return $result;
    }

    /**
     * add new shipping method to DB
     * 
     * @param array method attributes
     *
     * @return void
     */
    protected function addShippingMethod($service)
    {
        // Check if method has already been added in current session to prevent duplicates
        if (!in_array($service['service_code'], $this->newMethods)) {

            $method = new \XLite\Model\Shipping\Method();
            $method->setProcessor($this->getProcessorId());
            $method->setCarrier($this->getProcessorId());
            $method->setCode($service['service_code']);
            $method->setEnabled(false);
            $method->setName($service['service_name']);

            \XLite\Core\Database::getEM()->persist($method);
            \XLite\Core\Database::getEM()->flush();

            $this->newMethods[] = $service['service_code'];
        }
    }
}
