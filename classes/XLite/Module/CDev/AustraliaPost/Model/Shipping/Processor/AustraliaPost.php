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

namespace XLite\Module\CDev\AustraliaPost\Model\Shipping\Processor;

/**
 * Shipping processor model
 * API: Postage Assessment Calculator (PAC)
 * API documentation: http://auspost.com.au/devcentre/pacpcs.html
 * XCN-258
 * Shipments supported: Domestic(AU -> AU), International (AU -> Intl)
 */
class AustraliaPost extends \XLite\Model\Shipping\Processor\AProcessor
{
    /**
     * Option values TTL, in seconds (one week)
     */
    const OPTION_VALUES_TTL = 604800;


    /**
     * Unique processor Id
     *
     * @var string
     */
    protected $processorId = 'aupost';

    /**
     * Australia Post live API URL
     *
     * @var string
     */
    protected $liveApiURL = 'https://auspost.com.au';

    /**
     * Australia Post test API URL
     *
     * @var string
     */
    protected $testApiURL = 'https://test.npe.auspost.com.au';

    /**
     * Australia Post non-production API key (use in test mode only)
     *
     * @var string
     */
    protected $testApiKey = '28744ed5982391881611cca6cf5c2409';

    /**
     * API request types and some specifications
     *
     * @var array
     */
    protected $apiRequestTypes = array(

        'DomesticLetterService' => array(
            'uri'  => '/api/postage/letter/domestic/service',
            'validation' => array(
                'length'    => 260, // mm
                'width'     => 360, // mm
                'thickness' => 20,  // mm
                'weight'    => 500, // g
            ),
        ),

        'DomesticParcelService' => array(
            'uri'  => '/api/postage/parcel/domestic/service',
        ),

        'InternationalLetterService' => array(
            'uri'  => '/api/postage/letter/international/service',
            'validation' => array(
                'country_code' => 1,   // Compare with list of allowed countries
                'weight'       => 500, // g
            ),
        ),

        'InternationalParcelService' => array(
            'uri'  => '/api/postage/parcel/international/service',
            'validation' => array(
                'country_code' => 1,   // Compare with list of allowed countries
            ),
        ),

        'DomesticLetterPostage' => array(
            'uri'  => '/api/postage/letter/domestic/calculate',
            'validation' => array(
                'weight' => 500, // g
            ),
        ),

        'DomesticParcelPostage' => array(
            'uri'  => '/api/postage/parcel/domestic/calculate',
        ),

        'InternationalLetterPostage' => array(
            'uri'  => '/api/postage/letter/international/calculate',
            'validation' => array(
                'country_code' => 1,   // Compare with list of allowed countries
                'weight'       => 500, // g
            ),
        ),

        'InternationalParcelPostage' => array(
            'uri'  => '/api/postage/parcel/international/calculate',
            'validation' => array(
                'country_code' => 1,     // Compare with list of allowed countries
                'weight'       => 20000, // 20 kg
            ),
        ),

        'Country' => array(
            'uri'     => '/api/postage/country',
            'service' => true,
        ),

        'DomesticLetterThickness' => array(
            'uri'     => '/api/postage/letter/domestic/thickness',
            'service' => true,
        ),

        'DomesticLetterWeight' => array(
            'uri'     => '/api/postage/letter/domestic/weight',
            'service' => true,
        ),

        'DomesticLetterEnvelopeSize' => array(
            'uri'     => '/api/postage/letter/domestic/size',
            'service' => true,
        ),

        'InternationalLetterWeight' => array(
            'uri'     => '/api/postage/letter/international/weight',
            'service' => true,
        ),

        'InternationalParcelWeight' => array(
            'uri'     => '/api/postage/parcel/international/weight',
            'service' => true,
        ),

        'DomesticParcelWeight' => array(
            'uri'     => '/api/postage/parcel/domestic/weight',
            'service' => true,
        ),

        'DomesticParcelBoxType' => array(
            'uri'     => '/api/postage/parcel/domestic/type',
            'service' => true,
        ),

        'DomesticParcelBoxSize' => array(
            'uri'     => '/api/postage/parcel/domestic/size',
            'service' => true,
        ),
    );


    /**
     * Get package box type options array (used by Auspost configuration page)
     *
     * @return array
     */
    public static function getPackageBoxTypeOptions()
    {
        $result = \XLite\Core\Config::getInstance()->CDev->AustraliaPost->optionValues;

        return $result['DomesticParcelBoxSize']['data']['sizes']['size'];
    }

    /**
     * Get service options array (used by Auspost configuration page)
     *
     * @return array
     */
    public static function getAuspostServiceOptions()
    {
        return array(
            'AUS_SERVICE_OPTION_STANDARD'              => 'Standard Service',
            'AUS_SERVICE_OPTION_SIGNATURE_ON_DELIVERY' => 'Signature on Delivery',
        );
    }

    /**
     * This method must return the URL to the detailed tracking information about the package.
     * Tracking number is provided.
     *
     * @param string $trackingNumber
     *
     * @return null|string
     */
    public function getTrackingInformationURL($trackingNumber)
    {
        return 'http://auspost.com.au/track/track.html';
    }

    /**
     * Defines the form parameters of tracking information form
     *
     * @param string $trackingNumber Tracking number
     *
     * @return array Array of form parameters
     */
    public function getTrackingInformationParams($trackingNumber)
    {
        $list = parent::getTrackingInformationParams($trackingNumber);
        $list['exp']      = 'b';
        $list['trackIds'] = $trackingNumber;

        return $list;
    }

    /**
     * getProcessorName
     *
     * @return string
     */
    public function getProcessorName()
    {
        return 'Australia Post';
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
     * Get API URL depending on request type
     *
     * @param string $type Request type
     *
     * @return string
     */
    public function getApiURL()
    {
        return \XLite\Core\Config::getInstance()->CDev->AustraliaPost->test_mode ? $this->testApiURL : $this->liveApiURL;
    }

    /**
     * Get API key
     *
     * @return string
     */
    protected function getApiKey()
    {
        return \XLite\Core\Config::getInstance()->CDev->AustraliaPost->test_mode
            ? $this->testApiKey
            : \XLite\Core\Config::getInstance()->CDev->AustraliaPost->api_key;
    }

    /**
     * Get package limits
     *
     * @return array
     */
    protected function getPackageLimits()
    {
        $limits = parent::getPackageLimits();

        $config = \XLite\Core\Config::getInstance()->CDev->AustraliaPost;

        // Weight in store weight units
        $limits['weight'] = \XLite\Core\Converter::convertWeightUnits(
            $config->max_weight,
            'kg',
            \XLite\Core\Config::getInstance()->Units->weight_unit
        );

        list($limits['length'], $limits['width'], $limits['height']) = $this->getAuspostPackageSizes();

        return $limits;
    }

    /**
     * Renew allowed option values by rquesting them via AustraliaPost API
     *
     * @param boolean $force Force renewal
     *
     * @return boolean
     */
    public function updateServiceData($force = false)
    {
        $requestTypes = $this->getApiRequestType();

        $option = \XLite\Core\Config::getInstance()->CDev->AustraliaPost->optionValues;

        if (empty($option) || !is_array($option)) {
            $option = array();
        }

        $errors = array();
        $isUpdated = false;

        foreach ($requestTypes as $key => $value) {

            if (!empty($value['service']) && ($force || !$this->checkOptionValuesTTL($option, $key))) {

                $data = $this->doRequest($key);

                if (!isset($data['error'])) {

                    if ('Country' == $key) {
                        foreach ($data['countries']['country'] as $c) {
                            $dataTmp[] = $c['code'];
                        }
                        $data = $dataTmp;
                    }

                    $option[$key] = array(
                        'lastUpdated' => \XLite\Core\Converter::time(),
                        'data'        => $data,
                    );

                    $isUpdated = true;

                } else {
                    $errors[$key] = $data['error']['errorMessage'];
                }
            }
        }

        if ($isUpdated) {
            \XLite\Core\Database::getRepo('XLite\Model\Config')->createOption(
                array(
                    'category' => 'CDev\\AustraliaPost',
                    'name'     => 'optionValues',
                    'value'    => serialize($option),
                    'type'     => 'serialized',
                )
            );
        }

        return $errors;
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

            if (!empty($data)) {
                $rates = $this->doQuery($data, $ignoreCache);

            } else {
                $this->errorMsg = 'Wrong input data';
            }

        } else {
            $this->errorMsg = 'AustraliaPost module is not configured';
        }

        // Return shipping rates list
        return $rates;
    }


    /**
     * Returns true if AustraliaPost module is configured
     *
     * @return boolean
     */
    protected function isConfigured()
    {
        return \XLite\Core\Config::getInstance()->CDev->AustraliaPost->optionValues
            && (
                \XLite\Core\Config::getInstance()->CDev->AustraliaPost->test_mode
                || \XLite\Core\Config::getInstance()->CDev->AustraliaPost->api_key
            );
    }

    /**
     * prepareInputData
     *
     * @param array|\XLite\Logic\Order\Modifier\Shipping $modifier Shipping order modifier (from order) or array of input data (from test controller)
     *
     * @return void
     */
    protected function prepareInputData($inputData)
    {
        $data = array();

        if ($inputData instanceOf \XLite\Logic\Order\Modifier\Shipping) {
            $data = $this->prepareDataFromModifier($inputData);

        } else {
            $data = $inputData;
        }

        if (!empty($data['packages'])) {

            foreach ($data['packages'] as $key => $package) {

                if (!$this->isDstCountryValid($package['country_code'])) {
                    $data = array();
                    $this->errorMsg = 'There are no delivery to the country ' . $package['country_code'];
                    break;
                }

                $data['packages'][$key]['shipment_type'] = ('AU' == $package['country_code'] ? 'Domestic' : 'International');

                $data['packages'][$key]['package_type'] = \XLite\Core\Config::getInstance()->CDev->AustraliaPost->package_type;

                $data['packages'][$key]['weight'] = \XLite\Core\Converter::convertWeightUnits(
                    $package['weight'],
                    \XLite\Core\Config::getInstance()->Units->weight_unit,
                    'kg'
                );

                $data['packages'][$key]['subtotal'] = $this->getPackagesSubtotal($package['subtotal']);

                if (isset($data['packages'][$key]['box'])) {
                    $length = $data['packages'][$key]['box']['length'];
                    $width  = $data['packages'][$key]['box']['width'];
                    $height = $data['packages'][$key]['box']['height'];

                } else {
                    list($length, $width, $height) = $this->getAuspostPackageSizes();
                }

                $data['packages'][$key]['length'] = $length;
                $data['packages'][$key]['width']  = $width;
                $data['packages'][$key]['height'] = $height;
            }

        } else {
            $this->errorMsg = 'There are no defined packages to delivery';
        }

        return $data;
    }

    /**
     * Check if destination country code is allowed for delivery by AustraliaPost
     *
     * @param string $countryCode Destination country code
     *
     * @return boolean
     */
    protected function isDstCountryValid($countryCode)
    {
        $result = true;

        $options = \XLite\Core\Config::getInstance()->CDev->AustraliaPost->optionValues;

        if (!empty($options['Country'])) {
            $result = in_array($countryCode, $options['Country']);
        }

        return true;
    }

    /**
     * Return package dimensions in mm
     *
     * @return array
     */
    protected function getAuspostPackageSizes()
    {
        $length = $width = $height = 0;

        $packageBoxType = \XLite\Core\Config::getInstance()->CDev->AustraliaPost->package_box_type;

        if (!$packageBoxType) {
            $packageBoxType = 'AUS_PARCEL_TYPE_BOXED_OTH';
        }

        if ('AUS_PARCEL_TYPE_BOXED_OTH' != $packageBoxType) {

            $options = \XLite\Core\Config::getInstance()->CDev->AustraliaPost->optionValues;

            if (!empty($options['DomesticParcelBoxSize'])) {
                foreach ($options['DomesticParcelBoxSize']['data']['sizes']['size'] as $option) {

                    if ($packageBoxType == $option['code']) {
                        list($width, $height, $length) = explode('x', $option['value']);
                    }
                }
            }
        }

        if (0 == $length && 0 == $width && 0 == $height) {
            $length = \XLite\Core\Config::getInstance()->CDev->AustraliaPost->length;
            $width = \XLite\Core\Config::getInstance()->CDev->AustraliaPost->width;
            $height = \XLite\Core\Config::getInstance()->CDev->AustraliaPost->height;
        }

        return array($length, $width, $height);
    }

    /**
     * Prepare input data from order shipping modifier
     *
     * @param \XLite\Logic\Order\Modifier\Shipping $modifier Shipping order modifier
     *
     * @return array
     */
    protected function prepareDataFromModifier($modifier)
    {
        $data = array();

        if ('AU' == \XLite\Core\Config::getInstance()->Company->location_country) {

            $addrInfo = array();
            $addrInfo['from_postcode'] = \XLite\Core\Config::getInstance()->Company->location_zipcode;

            $dstAddress = \XLite\Model\Shipping::getInstance()->getDestinationAddress($modifier);

            if (isset($dstAddress)) {

                $addrInfo['to_postcode'] = $dstAddress['zipcode'];
                $addrInfo['country_code'] = $dstAddress['country'];

                $data['packages'] = $this->getPackages($modifier);

                foreach ($data['packages'] as $key => $package) {
                    $data['packages'][$key] = array_merge($package, $addrInfo);
                }
            }
        }

        return $data;
    }

    /**
     * doQuery
     *
     * @param mixed   $data        Can be either \XLite\Model\Order instance or an array
     * @param boolean $ignoreCache Flag: if true then do not get rates from cache
     *
     * @return void
     */
    protected function doQuery($data, $ignoreCache)
    {
        $rates = array();

        $packageRates = array();

        $currencyRate = $this->getCurrencyConversionRate();

        foreach ($data['packages'] as $pid => $package) {

            // Get services list

            $requestType = $package['shipment_type'] . $package['package_type'] . 'Service';

            $services = $this->doRequest($requestType, $package, $ignoreCache);

            // Get postage rates for specific services

            $services = isset($services['services']['service']) && is_array($services['services']['service'])
                ? $services['services']['service']
                : array();

            foreach($services as $service) {

                $requestType = $package['shipment_type'] . $package['package_type'] . 'Postage';

                $package['service_code'] = $service['code'];

                $package['options'] = array();

                if (!empty($service['options']['option'])) {

                    // Additional service options available

                    if (!empty($service['options']['option']['code'])) {

                        // Single option available

                        $option = array();

                        $option['code'] = $service['options']['option']['code'];

                        if (!empty($service['options']['option']['suboptions'])) {
                            $option['suboptions'] = $this->getSuboptions($service['options']['option']['suboptions']['option']);
                        }

                        $package['options'][] = $option;

                    } else {

                        // Multiple options available

                        foreach ($service['options']['option'] as $o) {

                            $option = array();

                            $option['code'] = $o['code'];

                            if (!empty($o['suboptions'])) {
                                $option['suboptions'] = $this->getSuboptions($o['suboptions']['option']);
                            }

                            $package['options'][] = $option;
                        }
                    }
                }

                $serviceRates = $this->doRequest($requestType, $package, $ignoreCache);

                // Prepare rates for package

                if (!empty($serviceRates['postage_result'])) {

                    $rate = new \XLite\Model\Shipping\Rate();
                    $rate->setBaseRate($serviceRates['postage_result']['total_cost'] * $currencyRate);

                    if (!empty($serviceRates['postage_result']['delivery_time'])) {
                        $extraData = new \XLite\Core\CommonCell();
                        $extraData->deliveryDays = $serviceRates['postage_result']['delivery_time'];

                        $rate->setExtraData($extraData);
                    }

                    // Save rates for each package
                    $packageRates[$service['code']]['packages'][$pid] = $rate;

                    // Save service name
                    $packageRates[$service['code']]['name'] = $serviceRates['postage_result']['service'];

                    // Save common rate (sum of rate totals of all packages)
                    if (!isset($packageRates[$service['code']]['rate'])) {
                        $packageRates[$service['code']]['rate'] = $rate;

                    } else {
                        $packageRates[$service['code']]['rate']->setBaseRate(
                            $packageRates[$service['code']]['rate']->getBaseRate() + $rate->getBaseRate()
                        );
                    }
                }
            }
        }

        // Prepare final rates

        if ($packageRates) {

            $availableMethods = \XLite\Core\Database::getRepo('XLite\Model\Shipping\Method')
                ->findMethodsByProcessor($this->getProcessorId(), false);

            foreach ($packageRates as $code => $info) {

                if (count($info['packages']) == count($data['packages'])) {

                    $method = null;

                    foreach ($availableMethods as $m) {
                        if ($m->getCode() == $code) {
                            $method = $m;
                            break;
                        }
                    }

                    if (!$method) {
                        // Create shipping method if it's does not exist
                        $method = \XLite\Core\Database::getRepo('XLite\Model\Shipping\Method')->createShippingMethod(
                            array(
                                'processor' => 'aupost',
                                'carrier'   => 'aupost',
                                'code'      => $code,
                                'enabled'   => \XLite\Core\Config::getInstance()->CDev->AustraliaPost->enable_new_methods,
                                'position'  => 0,
                                'name'      => 'Australia Post ' . $info['name'],
                            )
                        );
                    }

                    if ($method->getEnabled()) {
                        $info['rate']->setMethod($method);
                        $rates[] = $info['rate'];
                    }
                }
            }
        }

        return $rates;
    }

    /**
     * Parses response and returns an associative array
     *
     * @param string $stringData Response of AUPOST API
     * example:
     *   'charge=2.50
     *   days=1
     *   err_msg=OK
     *   '
     *
     * @return void
     */
    protected function parseResponse($stringData)
    {
        $result = array();

        foreach (explode("\n", $stringData) as $data) {

            $data = trim($data);

            if (!empty($data)) {
                list($key, $value) = explode('=', $data, 2);
                $result[trim($key)] = trim($value);
            }
        }

        return $result;
    }

    /**
     * Get API request type data
     *
     * @param string $type Request type OPTIONAL
     *
     * @return array
     */
    protected function getApiRequestType($type = null)
    {
        $result = array();

        if ($type && !empty($this->apiRequestTypes[$type])) {
            $result = $this->apiRequestTypes[$type];

        } elseif (!$type) {
            $result = $this->apiRequestTypes;
        }

        return $result;
    }

    /**
     * Do request to AustraliaPost API and receive response
     *
     * @param string  $type        Request type
     * @param array   $params      Array of parameters
     * @param boolean $ignoreCache Flag: ignore cache
     *
     * @return array|null
     */
    protected function doRequest($type, $params = array(), $ignoreCache = false)
    {
        $result = null;

        $requestType = $this->getApiRequestType($type);

        $methodName = 'getRequestData' . $type;

        if (method_exists($this, $methodName)) {
            // Call method to prepare request data
            $data = $this->$methodName($params);

        } else {
            $data = array();
        }

        // Validate request data
        if ($this->validateRequestData($requestType, $data)) {

            // Prepare post data
            $postData = array();

            foreach ($data as $key => $value) {

                if (in_array($key, array('option_code', 'suboption_code'))) {
                    foreach($value as $opcode) {
                        $postData[] = sprintf('%s=%s', $key, $opcode);
                    }

                } else {
                    $postData[] = sprintf('%s=%s', $key, $value);
                }
            }

            $postURL = $this->getApiURL() . $requestType['uri'] . '.json?' . implode('&', $postData);

            if (!$ignoreCache) {
                // Try to get cached result
                $cachedRate = $this->getDataFromCache($postURL . $this->getApiKey());
            }

            if (isset($cachedRate)) {
                // Get result from cache
                $result = $cachedRate;

            } else {

                // Get result from AustraliaPost server

                try {

                    $headers = array(
                        'AUTH-KEY: ' . $this->getApiKey(),
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $postURL);
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 15);

                    if (\XLite\Core\Config::getInstance()->CDev->AustraliaPost->test_mode) {
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    }

                    $response = curl_exec($ch);

                    if (!empty($response)) {
                        $result = json_decode($response, true);

                        if (!empty($result['error'])) {
                            $this->errorMsg = $result['error']['errorMessage'];

                        } else {
                            $this->saveDataInCache($postURL . $this->getApiKey(), $result);
                        }

                    } else {
                        $this->errorMsg = sprintf('Error while connecting to the AustraliaPost host (%s)', $postURL);
                    }

                    if ($ignoreCache === true) {

                        // Prepare data to display on Test AustraliaPost page
                        $this->apiCommunicationLog[] = array(
                            'request'  => $postURL,
                            'response' => htmlentities($response),
                            'parsed'   => $result,
                        );
                    }

                    if (\XLite\Core\Config::getInstance()->CDev->AustraliaPost->debug_enabled) {
                        // Log request and response
                        $log = array(
                            'postURL'  => $postURL,
                            'data'     => $data,
                            'result'   => $result,
                        );

                        \XLite\Logger::logCustom('AUSPOST', var_export($log, true));
                    }

                } catch (\Exception $e) {
                    $this->errorMsg = $e->getMessage();
                }
            }
        }

        return $result;

    }

    /**
     * Validate request data
     *
     * @param array $requestType Request type data
     * @param array $params      Input data for request
     *
     * @return boolean
     */
    protected function validateRequestData($requestType, $params)
    {
        $result = true;

        if (!empty($requestType['validation'])) {

            foreach ($requestType['validation'] as $option => $value) {

                if (!empty($params[$option])) {

                    if ('country_code' == $option) {
                        // Country is already validated above in prepareInputData() method

                    } elseif ($params[$option] > $value) {
                        $result = false;
                        $this->errorMsg = sprintf('Validation failed: %s = %s (max value: %s)', $option, $params[$option], $value);
                    }
                }

                if (!$result) {
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * Check option values TTL and return false if it is expired
     *
     * @param array  $option      Array of option values
     * @param string $requestType Request type
     *
     * @return boolean
     */
    protected function checkOptionValuesTTL($option, $requestType)
    {
        return empty($option[$requestType]['lastUpdated'])
            || self::OPTION_VALUES_TTL < (\XLite\Core\Converter::time() - $option[$requestType]['lastUpdated']);
    }

    /**
     * Get array of suboptions
     *
     * @param array $data Array of suboptions received via Auspost API
     *
     * @return array
     */
    protected function getSuboptions($data)
    {
        $result = array();

        if (!empty($data['code'])) {
            $result[] = $data['code'];

        } else {

            foreach ($data as $o) {
                $result[] = $o['code'];
            }
        }

        return $result;
    }

    /**
     * Get package subtotal with consideration of currency conversion rate
     *
     * @param float $subtotal
     *
     * @return float
     */
    protected function getPackagesSubtotal($subtotal)
    {
        return round($subtotal / $this->getCurrencyConversionRate(), 2);
    }

    /**
     * Get currency conversion rate
     *
     * @return float
     */
    protected function getCurrencyConversionRate()
    {
        $rate = doubleval(\XLite\Core\Config::getInstance()->CDev->AustraliaPost->currency_rate);

        return $rate ?: 1;
    }

    // {{{ Prepare data for specific request types

    /**
     * Prepare data for the specific request
     *
     * @param array $params Array of parameters
     *
     * @return array
     */
    protected function getRequestDataDomesticLetterService($params)
    {
        return array(
            'length'    => $params['length'],
            'width'     => $params['width'],
            'thickness' => $params['height'],
            'weight'    => $params['weight'],
        );
    }

    /**
     * Prepare data for the specific request
     *
     * @param array $params Array of parameters
     *
     * @return array
     */
    protected function getRequestDataDomesticParcelService($params)
    {
        return array(
            'from_postcode' => $params['from_postcode'],
            'to_postcode'   => $params['to_postcode'],
            'length'        => $params['length'],
            'width'         => $params['width'],
            'height'        => $params['height'],
            'weight'        => $params['weight'],
        );
    }

    /**
     * Prepare data for the specific request
     *
     * @param array $params Array of parameters
     *
     * @return array
     */
    protected function getRequestDataInternationalLetterService($params)
    {
        return array(
            'country_code' => $params['country_code'],
            'weight'       => $params['weight'],
        );
    }


    /**
     * Prepare data for the specific request
     *
     * @param array $params Array of parameters
     *
     * @return array
     */
    protected function getRequestDataInternationalParcelService($params)
    {
        return array(
            'country_code' => $params['country_code'],
            'weight'       => $params['weight'],
        );
    }

    /**
     * Prepare data for the specific request
     *
     * @param array $params Array of parameters
     *
     * @return array
     */
    protected function getRequestDataDomesticLetterPostage($params)
    {
        $data = array(
            'service_code' => $params['service_code'],
            'weight'       => $params['weight'],
        );

        if (!empty($params['options'])) {
            $this->getPackageServiceOptions($params, $data);
        }

        return $data;
    }

    /**
     * Prepare data for the specific request
     *
     * @param array $params Array of parameters
     *
     * @return array
     */
    protected function getRequestDataDomesticParcelPostage($params)
    {
        $data = array(
            'service_code'  => $params['service_code'],
            'from_postcode' => $params['from_postcode'],
            'to_postcode'   => $params['to_postcode'],
            'length'        => $params['length'],
            'width'         => $params['width'],
            'height'        => $params['height'],
            'weight'        => $params['weight'],
        );


        if (!empty($params['options'])) {
            $this->getPackageServiceOptions($params, $data);
        }

        return $data;
    }

    /**
     * Prepare data for the specific request
     *
     * @param array $params Array of parameters
     *
     * @return array
     */
    protected function getRequestDataInternationalLetterPostage($params)
    {
        $data = array(
            'service_code' => $params['service_code'],
            'country_code' => $params['country_code'],
            'weight'       => $params['weight'],
        );

        if (!empty($params['options'])) {
            $this->getPackageServiceOptions($params, $data);
        }

        return $data;
    }

    /**
     * Prepare data for the specific request
     *
     * @param array $params Array of parameters
     *
     * @return array
     */
    protected function getRequestDataInternationalParcelPostage($params)
    {
        $data = array(
            'service_code' => $params['service_code'],
            'country_code' => $params['country_code'],
            'weight'       => $params['weight'],
        );

        if (!empty($params['options'])) {
            $this->getPackageServiceOptions($params, $data);
        }

        return $data;
    }

    /**
     * Prepare service options data
     *
     * @param array $params Array of package parameters
     * @param array &$data  Array of data for request
     *
     * @return array
     */
    protected function getPackageServiceOptions($params, &$data)
    {
        foreach($params['options'] as $option) {

            if ('INTL_SERVICE_OPTION_EXTRA_COVER' == $option['code']) {

                if (\XLite\Core\Config::getInstance()->CDev->AustraliaPost->extra_cover) {
                    $data['option_code'][] = $option['code'];
                }

            } elseif ($option['code'] == \XLite\Core\Config::getInstance()->CDev->AustraliaPost->service_option) {

                $data['option_code'][] = $option['code'];

                if (!empty($option['suboptions'])) {
                    foreach($option['suboptions'] as $suboption) {

                        if ('AUS_SERVICE_OPTION_EXTRA_COVER' == $suboption && \XLite\Core\Config::getInstance()->CDev->AustraliaPost->extra_cover) {
                            $data['suboption_code'][] = $suboption;
                        }
                    }
                }
            }
        }

        if (\XLite\Core\Config::getInstance()->CDev->AustraliaPost->extra_cover) {

            $data['extra_cover'] = 0 < doubleval(\XLite\Core\Config::getInstance()->CDev->AustraliaPost->extra_cover_value)
                ? round(\XLite\Core\Config::getInstance()->CDev->AustraliaPost->extra_cover_value, 2)
                : $params['subtotal'];

            $data['extra_cover'] = min($data['extra_cover'], 5000);
        }

        return $data;
    }

    // }}}

}
