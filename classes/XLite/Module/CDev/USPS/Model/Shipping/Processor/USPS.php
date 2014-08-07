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

namespace XLite\Module\CDev\USPS\Model\Shipping\Processor;

/**
 * USPS shipping processor model
 * API documentation: https://www.usps.com/business/webtools-technical-guides.htm
 */
class USPS extends \XLite\Model\Shipping\Processor\AProcessor
{
    /**
     * Types of available API
     */
    const USPS_API_DOMESTIC = 'Domestic';
    const USPS_API_INTL     = 'Intl';

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
    protected $processorId = 'usps';

    /**
     * Type of API (Domestic | International)
     *
     * @var string
     */
    protected $apiType = null;

    // {{{

    public static function getServices()
    {
        return array(
            'FIRST CLASS'   => array(
                'name' => 'First Class',
                'subServices' => array(
                    'COMMERCIAL',

                ),
            ),
            'PRIORITY'      => array(
                'name' => 'Priority',
                'subServices' => array(
                    'COMMERCIAL',
                    'CPP',
                ),
            ),
            'EXPRESS'       => array(
                'name' => 'Express',
                'subServices' => array(
                    'COMMERCIAL',
                    'CPP',
                    'SH',
                    'SH COMMERCIAL',
                ),
            ),
            'STANDARD POST' => array(
                'name' => 'Standard Post',
            ),
            'MEDIA'         => array(
                'name' => 'Media',
            ),
            'LIBRARY'       => array(
                'name' => 'Library',
            ),
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
        return 'https://tools.usps.com/go/TrackConfirmAction.action';
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
        $list['tLabels']    = $trackingNumber;
        $list['tRef']       = 'fullpage';
        $list['tLc']        = 5;
        $list['text28777']  = '';

        return $list;
    }

    /**
     * Returns processor name (displayed name)
     *
     * @return string
     */
    public function getProcessorName()
    {
        return 'U.S.P.S.';
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
     * Returns shipping rates by shipping order modifier (used on checkout)
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

        if ($this->isConfigured() && 'US' == \XLite\Core\Config::getInstance()->Company->location_country) {

            $data = $this->prepareRequestData($inputData);

            if (isset($data)) {

                if (self::USPS_API_DOMESTIC == $this->getApiType()) {

                    // Get Domestic rates

                    foreach (static::getServices() as $code => $serviceData) {

                        $services = array();
                        $services[] = $code;

                        if (!empty($serviceData['subServices'])) {
                            foreach ($serviceData['subServices'] as $ssCode) {
                                $services[] = $code . ' ' . $ssCode;
                            }
                        }

                        foreach ($services as $serviceCode) {
                            $data['serviceCode'] = $serviceCode;

                            $this->errorMsg = null;

                            $serviceRates = $this->doQuery($data, $ignoreCache);

                            $rates = array_merge($rates, $serviceRates);
                        }
                    }

                } else {
                    // Get International rates
                    $rates = $this->doQuery($data, $ignoreCache);
                }

                if (!empty($rates)) {
                    $this->errorMsg = null;
                }

            } else {
                $this->errorMsg = 'Wrong input data';
            }

        } else {
            $this->errorMsg = 'U.S.P.S. module is not configured or origin country is not United States';
        }

        return $rates;
    }

    /**
     * Get package limits
     *
     * @return array
     */
    protected function getPackageLimits()
    {
        $limits = parent::getPackageLimits();

        $config = \XLite\Core\Config::getInstance()->CDev->USPS;

        $limits['weight'] = $config->max_weight;

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
    protected function prepareRequestData($inputData)
    {
        $result = array();

        $data = array();
        $data['packages'] = array();

        if ($inputData instanceOf \XLite\Logic\Order\Modifier\Shipping) {
            $data['srcAddress'] = array(
                'zipcode' => \XLite\Core\Config::getInstance()->Company->location_zipcode,
            );
            $data['dstAddress'] = \XLite\Model\Shipping::getInstance()->getDestinationAddress($inputData);
            $data['packages'] = $this->getPackages($inputData);

            // Detect if COD payment method has been selected by customer on checkout

            if ($inputData->getOrder()->getFirstOpenPaymentTransaction()) {

                $paymentMethod = $inputData->getOrder()->getPaymentMethod();

                if ($paymentMethod && 'COD_USPS' == $paymentMethod->getServiceName()) {
                    $data['cod_enabled'] = true;
                }
            }

        } else {
            $data = $inputData;
        }

        if (!empty($data['packages']) && isset($data['srcAddress']) && isset($data['dstAddress'])) {

            $this->setApiType($data['dstAddress']);

            $result['USERID'] = \XLite\Core\Config::getInstance()->CDev->USPS->userid;
            $result['packages'] = array();
            $result['cod_enabled'] = !empty($data['cod_enabled']);

            foreach ($data['packages'] as $packKey => $package) {
                $result['packages'][] = $this->{'prepareRequestData' . $this->getApiType()}($data, $packKey);
            }

        } else {
            $result = null;
        }

        return $result;
    }

    /**
     * Performs request to USPS server and returns array of rates
     *
     * @param array   $data        Array of request parameters
     * @param boolean $ignoreCache Flag: if true then do not get rates from cache
     *
     * @return array
     */
    protected function doQuery($data, $ignoreCache)
    {
        $result = null;
        $rates = array();

        $availableMethods = \XLite\Core\Database::getRepo('XLite\Model\Shipping\Method')
            ->findMethodsByProcessor($this->getProcessorId());

        if ($availableMethods) {

            $xmlData = $this->getXMLData($data);

            $currencyRate = doubleval(\XLite\Core\Config::getInstance()->CDev->USPS->currency_rate);
            $currencyRate = (0 < $currencyRate ? $currencyRate : 1);

            $postURL = $this->getApiURL() . '?API=' . $this->getApiName() . '&XML=' . urlencode($xmlData);

            try {

                if (!$ignoreCache) {
                    $cachedRate = $this->getDataFromCache($postURL);
                }

                if (isset($cachedRate)) {
                    $result = $cachedRate;

                } else {

                    $bouncer  = new \XLite\Core\HTTP\Request($postURL);
                    $bouncer->requestTimeout = 5;
                    $response = $bouncer->sendRequest();

                    if ($response && 200 == $response->code) {
                        $result = $response->body;
                        $this->saveDataInCache($postURL, $result);

                        if (\XLite\Core\Config::getInstance()->CDev->USPS->debug_enabled) {
                            \XLite\Logger::logCustom(
                                'USPS',
                                var_export(
                                    array(
                                        'Request URL' => $postURL,
                                        'Request XML' => $xmlData,
                                        'Response'    => \XLite\Core\XML::getInstance()->getFormattedXML($result),
                                    ),
                                    true
                                )
                            );
                        }

                    } else {
                        $this->errorMsg = sprintf('Error while connecting to the USPS host (%s)', $this->getApiURL());
                    }
                }

                $response = isset($this->errorMsg)
                    ? array()
                    : $this->parseResponse($result);

                $this->apiCommunicationLog[] = array(
                    'request'  => $postURL,
                    'xml'      => htmlentities(preg_replace('/(USERID=")([^"]+)/', '\1***', $xmlData)),
                    'response' => htmlentities(\XLite\Core\XML::getInstance()->getFormattedXML($result)),
                );

                if (!isset($this->errorMsg) && !isset($response['err_msg']) && !empty($response['postage'])) {

                    foreach ($response['postage'] as $postage) {

                        $rate = new \XLite\Model\Shipping\Rate();

                        $method = $this->getShippingMethod($postage['CLASSID'], $availableMethods);

                        if (!isset($method)) {
                            // Unknown method received: add this to the database with disabled status
                            $method = $this->addShippingMethod($postage);
                        }

                        if ($method && $method->getEnabled()) {
                            // Method is registered and enabled

                            $rate->setMethod($method);

                            $codPrice = 0;

                            $rateValue = doubleval($postage['Rate']);

                            if (isset($postage['SpecialServices'])) {

                                if (isset($postage['SpecialServices'][6]) && 'true' == $postage['SpecialServices'][6]['Available']) {
                                    // Shipping service supports COD
                                    $extraData = new \XLite\Core\CommonCell();
                                    $extraData->cod_supported = true;
                                    $extraData->cod_rate = ($rateValue + doubleval($postage['SpecialServices'][6]['Price'])) * $currencyRate;
                                    $rate->setExtraData($extraData);

                                    if ($data['cod_enabled']) {
                                        // Calculate COD fee if COD payment method is selected
                                        $codPrice = doubleval($postage['SpecialServices'][6]['Price']);
                                    }
                                }
                            }

                            // Base rate is a sum of base rate and COD fee
                            $rate->setBaseRate(($rateValue + $codPrice) * $currencyRate);

                            if (isset($rates[$postage['MailService']])) {

                                // Multipackaging: sum base rate and COD fee for each rated packages

                                $rates[$postage['MailService']]->setBaseRate(
                                    $rates[$postage['MailService']]->getBaseRate() + $rate->getBaseRate()
                                );

                                if ($rate->getExtraData()->cod_rate) {
                                    $extra = $rates[$postage['MailService']]->getExtraData();
                                    $extra->cod_rate = $extra->cod_rate + $rate->getExtraData()->cod_rate;
                                    $rates[$postage['MailService']]->setExtraData($extra);
                                }

                            } else {
                                $rates[$postage['MailService']] = $rate;
                            }
                        }
                    }

                } elseif (!isset($this->errorMsg)) {
                    $this->errorMsg = (isset($response['err_msg']) ? $response['err_msg'] : 'Unknown error');
                }

            } catch (\Exception $e) {
                $this->errorMsg = 'Exception: ' . $e->getMessage();
            }
        }

        return $rates;
    }

    /**
     * Parses response for current type of API and returns an associative array
     *
     * @param string $data Response received from USPS
     *
     * @return array
     */
    protected function parseResponse($data)
    {
        return $this->{'parseResponse' . $this->getApiType()}($data);
    }

    /**
     * Returns XML-formatted request string for current type of API
     *
     * @param array $data Array of request values
     *
     * @return string
     */
    protected function getXMLData($data)
    {
        return $this->{'getXMLData' . $this->getApiType()}($data);
    }

    // }}}

    // {{{ Domestic API specific methods

    /**
     * Returns array of data for package (RateV4 request)
     *
     * @param array  $data    Array of input data
     * @param string $packKey Key of current package
     *
     * @return array
     */
    protected function prepareRequestDataDomestic($data, $packKey)
    {
        list($pounds, $ounces) = $this->getPoundsOunces($data['packages'][$packKey]['weight']);

        $config = \XLite\Core\Config::getInstance()->CDev->USPS;
        $dim = isset($data['packages'][$packKey]['box'])
            ? $data['packages'][$packKey]['box']
            : $data['packages'][$packKey];

        $result = array(
            'ZipOrigination' => $this->sanitizeZipcode($data['srcAddress']['zipcode']), // lenght=5, pattern=/\d{5}/
            'ZipDestination' => $this->sanitizeZipcode($data['dstAddress']['zipcode']), // lenght=5, pattern=/\d{5}/
            'Pounds' => intval($pounds), // integer, range=0-70
            'Ounces' => sprintf('%.1f', $ounces), // decimal, range=0.0-1120.0, totalDigits=10
            'Container' => $config->container,  // RECTANGULAR | NONRECTANGULAR | ...
            'Size' => $config->package_size,  // REGULAR | LARGE
            'Width' => sprintf('%.1f', $dim['width']), // Units=inches, decimal, min=0.0, totalDigits=10. Required for LARGE
            'Length' => sprintf('%.1f', $dim['length']), // Units=inches, decimal, min=0.0, totalDigits=10. Required for LARGE
            'Height' => sprintf('%.1f', $dim['height']), // Units=inches, decimal, min=0.0, totalDigits=10. Required for LARGE
            'Girth' => sprintf('%.1f', $config->girth), // Units=inches, decimal, min=0.0, totalDigits=10. Required for size=LARGE and container=NONRECTANGULAR | VARIABLE/NULL
            'Value' => sprintf('%.2f', $data['packages'][$packKey]['subtotal']), // decimal, min=0.00, totalDigits=10
            'Machinable' => $config->machinable ? 'true' : 'false',
            'AmountToCollect' => $data['packages'][$packKey]['subtotal'],
        );

        return $result;
    }

    /**
     * Returns XML-formatted string for RateV4 request
     *
     * @param array $data Array of request values
     *
     * @return string
     */
    protected function getXMLDataDomestic($data)
    {
        $packId = 0;

        $packagesXML = '';

        foreach ($data['packages'] as $pack) {

            $packId++;

            $packIdStr = sprintf('%02d', $packId);

            if (
                !empty($pack['Girth'])
                && 0 < doubleval($pack['Girth'])
                && in_array($pack['Container'], array('NONRECTANGULAR', 'VARIABLE'))
            ) {

                $girth = <<<OUT
        <Girth>{$pack['Girth']}</Girth>
OUT;
            } else {
                $girth = '';
            }

            $amountToCollectXML = <<<OUT
        <AmountToCollect>{$pack['AmountToCollect']}</AmountToCollect>
OUT;

            if (preg_match('/FIRST CLASS/', $data['serviceCode'])) {
                $firstClassMailTypeXML = <<<OUT
        <FirstClassMailType>PARCEL</FirstClassMailType>
OUT;

            } else {
                $firstClassMailTypeXML = '';
            }

            $packagesXML .= <<<OUT
    <Package ID="{$packIdStr}">
        <Service>{$data['serviceCode']}</Service>
$firstClassMailTypeXML
        <ZipOrigination>{$pack['ZipOrigination']}</ZipOrigination>
        <ZipDestination>{$pack['ZipDestination']}</ZipDestination>
        <Pounds>{$pack['Pounds']}</Pounds>
        <Ounces>{$pack['Ounces']}</Ounces>
        <Container>{$pack['Container']}</Container>
        <Size>{$pack['Size']}</Size>
        <Width>{$pack['Width']}</Width>
        <Length>{$pack['Length']}</Length>
        <Height>{$pack['Height']}</Height>
$girth
        <Value>{$pack['Value']}</Value>
$amountToCollectXML
        <Machinable>{$pack['Machinable']}</Machinable>
    </Package>
OUT;
        }

        return <<<OUT
<{$this->getApiName()}Request USERID="{$data['USERID']}">
    <Revision>2</Revision>
$packagesXML
</{$this->getApiName()}Request>
OUT;
    }

    /**
     * Parses RateV4 response and returns an associative array
     *
     * @param string $stringData Response received from USPS
     *
     * @return array
     */
    protected function parseResponseDomestic($stringData)
    {
        $result = array();

        $xml = \XLite\Core\XML::getInstance();

        $xmlParsed = $xml->parse($stringData, $err);

        if (isset($xmlParsed['Error'])) {
            $result['err_msg'] = $xml->getArrayByPath($xmlParsed, 'Error/Description/0/#');

        } else {

            $error = $xml->getArrayByPath($xmlParsed, $this->getApiName() . 'Response/Package/Error');

            if ($error) {
                $result['err_msg'] = $xml->getArrayByPath($error, 'Description/0/#');
            }
        }

        if (!isset($result['error_msg'])) {

            $packages = $xml->getArrayByPath($xmlParsed, $this->getApiName() . 'Response/Package');

            if ($packages) {

                foreach ($packages as $i => $package) {

                    $postage = $xml->getArrayByPath($package, '#/Postage');

                    if ($postage) {
                        foreach ($postage as $k => $v) {
                            $serviceName = $xml->getArrayByPath($v, '#/MailService/0/#');
                            $postageData = array(
                                'CLASSID' => 'D-' . $xml->getArrayByPath($v, '@/CLASSID') . '-' . md5($serviceName),
                                'MailService' => $this->getUSPSNamePrefix() . $this->sanitizeServiceName($serviceName),
                                'Rate' => $xml->getArrayByPath($v, '#/Rate/0/#'),
                            );

                            $specialServices = $xml->getArrayByPath($v, '#/SpecialServices/0/#');

                            if (isset($specialServices['SpecialService']) && is_array($specialServices['SpecialService'])) {

                                foreach ($specialServices['SpecialService'] as $service) {
                                    $rateServices = array(
                                        'ServiceID'   => $xml->getArrayByPath($service, '#/ServiceID/0/#'),
                                        'ServiceName' => $xml->getArrayByPath($service, '#/ServiceName/0/#'),
                                        'Available'   => $xml->getArrayByPath($service, '#/Available/0/#'),
                                        'Price'       => $xml->getArrayByPath($service, '#/Price/0/#'),
                                    );
                                    $postageData['SpecialServices'][$rateServices['ServiceID']] = $rateServices;
                                }
                            }

                            $result['postage'][] = $postageData;
                        }

                    } else {
                        $result = array();
                        break;
                    }
                }
            }
        }

        return $result;
    }

    // }}} Domestic API specific methods

    // {{{ International API specific methods

    /**
     * Returns array of data for package (IntlRateV2 request)
     *
     * @param array  $data    Array of input data
     * @param string $packKey Key of current package
     *
     * @return array
     */
    protected function prepareRequestDataIntl($data, $packKey)
    {
        list($pounds, $ounces) = $this->getPoundsOunces($data['packages'][$packKey]['weight']);

        $config = \XLite\Core\Config::getInstance()->CDev->USPS;

        $result = array(
            'Pounds' => intval($pounds), // integer, range=0-70
            'Ounces' => sprintf('%.1f', $ounces), // decimal, range=0.0-1120.0, totalDigits=10
            'Machinable' => $config->machinable ? 'true' : 'false',
            'MailType' => $config->mail_type,  // Package | Postcards or aerogrammes | Envelope | LargeEnvelope | FlatRate
            'ValueOfContents' => sprintf('%.2f', $data['packages'][$packKey]['subtotal']), // decimal
            'Country' => $this->getUSPSCountryByCode($data['dstAddress']['country']), // lenght=5, pattern=/\d{5}/
            'Container' => $config->container_intl,  // RECTANGULAR | NONRECTANGULAR
            'Size' => $config->package_size,  // REGULAR | LARGE
            'Width' => sprintf('%.1f', $config->width), // Units=inches, decimal, min=0.0, totalDigits=10. Required for LARGE
            'Length' => sprintf('%.1f', $config->length), // Units=inches, decimal, min=0.0, totalDigits=10. Required for LARGE
            'Height' => sprintf('%.1f', $config->height), // Units=inches, decimal, min=0.0, totalDigits=10. Required for LARGE
            'Girth' => sprintf('%.1f', $config->girth), // Units=inches, decimal, min=0.0, totalDigits=10. Required for size=LARGE and container=NONRECTANGULAR | VARIABLE/NULL
            'GXG' => $config->gxg,
            'GXGPOBoxFlag' => $config->gxg_pobox ? 'Y' : 'N',
            'GXGGiftFlag' => $config->gxg_gift ? 'Y' : 'N',
            'OriginZip' => $this->sanitizeZipcode($data['srcAddress']['zipcode']), // lenght=5, pattern=/\d{5}/
            'CommercialFlag' => $config->commercial ? 'Y' : 'N', // Y | N
            'ExtraServices' => array(),
        );

        return $result;
    }

    /**
     * Returns XML-formatted string for IntlRateV2 request
     *
     * @param array $data Array of request values
     *
     * @return string
     */
    protected function getXMLDataIntl($data)
    {
        $packId = 0;

        foreach ($data['packages'] as $pack) {

            $packId++;

            $packIdStr = sprintf('%02d', $packId);

            if ($pack['GXG']) {
                $gxg = <<<OUT
        <GXG>
            <POBoxFlag>{$pack['GXGPOBoxFlag']}</POBoxFlag>
            <GiftFlag>{$pack['GXGGiftFlag']}</GiftFlag>
        </GXG>
OUT;
            } else {
                $gxg = '';
            }

            $packages = <<<OUT
    <Package ID="{$packIdStr}">
        <Pounds>{$pack['Pounds']}</Pounds>
        <Ounces>{$pack['Ounces']}</Ounces>
        <Machinable>{$pack['Machinable']}</Machinable>
        <MailType>{$pack['MailType']}</MailType>
$gxg
        <ValueOfContents>{$pack['ValueOfContents']}</ValueOfContents>
        <Country>{$pack['Country']}</Country>
        <Container>{$pack['Container']}</Container>
        <Size>REGULAR</Size>
        <Width>{$pack['Width']}</Width>
        <Length>{$pack['Length']}</Length>
        <Height>{$pack['Height']}</Height>
        <Girth>{$pack['Girth']}</Girth>
        <OriginZip>{$pack['OriginZip']}</OriginZip>
        <CommercialFlag>{$pack['CommercialFlag']}</CommercialFlag>
    </Package>
OUT;
        }

        return <<<OUT
<{$this->getApiName()}Request USERID="{$data['USERID']}">
    <Revision>2</Revision>
$packages
</{$this->getApiName()}Request>
OUT;
    }

    /**
     * Parses IntlRateV2 response and returns an associative array
     *
     * @param string $stringData Response received from USPS
     *
     * @return array
     */
    protected function parseResponseIntl($stringData)
    {
        $result = array();

        $xml = \XLite\Core\XML::getInstance();

        $xmlParsed = $xml->parse($stringData, $err);

        if (isset($xmlParsed['Error'])) {
            $result['err_msg'] = $xml->getArrayByPath($xmlParsed, 'Error/Description/0/#');

        } else {

            $error = $xml->getArrayByPath($xmlParsed, $this->getApiName() . 'Response/Package/Error');

            if ($error) {
                $result['err_msg'] = $xml->getArrayByPath($error, 'Description/0/#');
            }
        }

        if (!isset($result['err_msg'])) {

            $postage = $xml->getArrayByPath($xmlParsed, $this->getApiName() . 'Response/Package/Service');

            if ($postage) {
                foreach ($postage as $k => $v) {
                    $serviceName = $xml->getArrayByPath($v, '#/SvcDescription/0/#');
                    $result['postage'][] = array(
                        'CLASSID' => 'I-' . $xml->getArrayByPath($v, '@/ID') . '-' . md5($serviceName),
                        'MailService' => $this->getUSPSNamePrefix() . $this->sanitizeServiceName($serviceName),
                        'Rate' => $xml->getArrayByPath($v, '#/Postage/0/#'),
                    );
                }
            }
        }

        return $result;
    }

    // }}} International API specific methods

    // {{{ Service methods

    /**
     * Returns API URL
     *
     * @return string
     */
    public function getApiURL()
    {
        return \XLite\Core\Config::getInstance()->CDev->USPS->server_url
            ? \XLite\Core\Config::getInstance()->CDev->USPS->server_url
            : 'http://testing.shippingapis.com/ShippingAPI.dll';
    }

    /**
     * Returns array(pounds, ounces) from a weight value in specific weight units
     *
     * @param float $weight Weight value
     *
     * @return array
     */
    public function getPoundsOunces($weight)
    {
        $pounds = $ounces = 0;

        switch (\XLite\Core\Config::getInstance()->Units->weight_unit) {

            case 'lbs':
                $pounds = $weight;
                break;

            case 'oz':
                $ounces = $weight;
                break;

            default:
                $ounces = \XLite\Core\Converter::convertWeightUnits(
                    $weight,
                    \XLite\Core\Config::getInstance()->Units->weight_unit,
                    'oz'
                );
        }

        if (intval($pounds) < $pounds) {
            $ounces = ($pounds - intval($pounds)) * 16;
            $pounds = intval($pounds);
        }

        return array($pounds, round($ounces, 1));
    }

    /**
     * Returns shipping method name prefix
     *
     * @return string
     */
    public function getUSPSNamePrefix()
    {
        return $this->getProcessorName() . ' ';
    }


    /**
     * Returns a type of API
     *
     * @return void
     */
    protected function getApiType()
    {
        return $this->apiType;
    }

    /**
     * Set a type of API (domestic | intrnational) depending on destination country
     *
     * @param array $address Array of address data
     *
     * @return void
     */
    protected function setApiType($address)
    {
        $this->apiType = ('US' == $address['country'] ? self::USPS_API_DOMESTIC : self::USPS_API_INTL);
    }

    /**
     * Returns the name of API
     *
     * @return string
     */
    protected function getApiName()
    {
        $apiName = array(
            self::USPS_API_DOMESTIC => 'RateV4',
            self::USPS_API_INTL     => 'IntlRateV2',
        );

        return $apiName[$this->getApiType()];
    }

    /**
     * Returns true if USPS module is configured
     *
     * @return boolean
     */
    protected function isConfigured()
    {
        return \XLite\Core\Config::getInstance()->CDev->USPS->userid
            && \XLite\Core\Config::getInstance()->CDev->USPS->server_url;
    }

    /**
     * Returns shipping method
     *
     * @param string $code             Unique code of payment method
     * @param array  $availableMethods Array of shipping methods objects gathered from database
     *
     * @return \XLite\Model\Shipping\Method
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
     * Add shipping method to the database
     *
     * @param array $postage Array of data for shipping method
     *
     * @return void
     */
    protected function addShippingMethod($postage)
    {
        $method = null;

        // Check if method has alreaby been added in current session to prevent duplicates
        if (!in_array($postage['CLASSID'], $this->newMethods)) {

            $method = new \XLite\Model\Shipping\Method();
            $method->setProcessor($this->getProcessorId());
            $method->setCarrier($this->getProcessorId());
            $method->setCode($postage['CLASSID']);
            $method->setEnabled(\XLite\Core\Config::getInstance()->CDev->USPS->autoenable_new_methods);
            $method->setName($postage['MailService']);

            \XLite\Core\Database::getEM()->persist($method);
            \XLite\Core\Database::getEM()->flush();

            $this->newMethods[] = $postage['CLASSID'];
        }

        return $method;
    }

    /**
     * Returns a name of country which is suitable for USPS API
     *
     * @param string $code Country code
     *
     * @return string
     */
    protected function getUSPSCountryByCode($code)
    {
        static $uspsCountries = array(
            'AE' => 'United Arab Emirates',
            'PG' => 'Papua New Guinea',
            'AF' => 'Afghanistan',
            'NZ' => 'New Zealand',
            'FI' => 'Finland',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia-Herzegovina',
            'BW' => 'Botswana',
            'BR' => 'Brazil',
            'VG' => 'British Virgin Islands',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'MM' => 'Burma',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Rep.',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo, Democratic Republic of the',
            'CR' => 'Costa Rica',
            'CI' => 'Cte d\'Ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia, Republic of',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GB' => 'Great Britain and Northern Ireland',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KP' => 'Korea, Democratic People\'s Republic of',
            'KR' => 'Korea, Republic of (South Korea)',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Laos',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'MX' => 'Mexico',
            'FM' => 'Micronesia, Federated States of',
            'MD' => 'Moldova',
            'MN' => 'Mongolia',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'MP' => 'Northern Mariana Islands, Commonwealth',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'AS' => 'American Samoa',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PA' => 'Panama',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn Island',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russia',
            'RW' => 'Rwanda',
            'KN' => 'Saint Christopher (St. Kitts) and Nevis',
            'SH' => 'Saint Helena',
            'LC' => 'Saint Lucia',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and the Grenadines',
            'WS' => 'Samoa, American',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovak Republic',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania',
            'TH' => 'Thailand',
            'TG' => 'Togo',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VA' => 'Vatican City',
            'VE' => 'Venezuela',
            'VN' => 'Vietnam',
            'VI' => 'Virgin Islands U.S.',
            'WF' => 'Wallis and Futuna Islands',
            'YE' => 'Yemen',
            'YU' => 'Yugoslavia',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
            'CC' => 'Cocos Island',
            'CK' => 'Cook Islands',
            'TP' => 'East Timor',
            'YT' => 'Mayotte',
            'MC' => 'Monaco',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'TK' => 'Tokelau (Union) Group',
            'UK' => 'United Kingdom',
            'CX' => 'Christmas Island',
            'US' => 'United States',
        );

        return (isset($uspsCountries[$code]) ? $uspsCountries[$code] : null);
    }

    /**
     * Sanitize zipcode value according to USPS requirements, pattern: /\d{5}/
     *
     * @param string $zipcode Zipcode value
     *
     * @return string
     */
    protected function sanitizeZipcode($zipcode)
    {
        return preg_replace('/\D/', '', substr($zipcode, 0, 5));
    }

    /**
     * Sanitize service name returned by USPS
     *
     * @param string $zipcode Zipcode value
     *
     * @return string
     */
    protected function sanitizeServiceName($value)
    {
        $list = get_html_translation_table();

        return strtr($value, array_flip($list));
    }

    // }}}
}
