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

namespace XLite\Module\XC\CanadaPost\Core\Service;

/**
 * Implementation of the Canada Post's "Rating" service
 *
 * Service Summary:
 *
 *   Use the rating services to get shipping costs between two points at various speeds of service and
 *   with requested add-on features.
 *
 * More info at:
 *
 *   https://www.canadapost.ca/cpo/mc/business/productsservices/developers/services/rating/default.jsf
 *
 * Implemented calls:
 *
 *   Get Service
 *
 */
class Rating extends \XLite\Module\XC\CanadaPost\Core\Service\AService
{
    // {{{ "Get Service" call

    /**
     * Call "Get Service" request by the service code and country code
     *
     * @param string $code        Delivery service code
     * @param string $countryCode Country code (OPTIONAL)
     *
     * @return \XLite\Core\CommonCell
     */
    public function callGetServiceByCode($code, $countryCode = '')
    {
        $endpoint = 'https://'
            . $this->getApiHost(static::getCanadaPostConfig()->developer_mode)
            . '/rs/ship/service/' . $code;

        if (!empty($countryCode)) {
            $endpoint .= '?country=' .  $countryCode;
        }

        return $this->callGetServiceByEndpoint($endpoint);
    }

    /**
     * Call "Get Service" request by the provided endpoint (URL)
     *
     * @param string $endpoint     Service endpoint (URL)
     * @param string $acceptHeader Accept header value (OPTIONAL)
     *
     * @return \XLite\Core\CommonCell
     */
    public function callGetServiceByEndpoint($endpoint, $acceptHeader = 'application/vnd.cpc.ship.rate-v2+xml')
    {
        return $this->callGetService($endpoint, $acceptHeader);
    }

    /**
     * Call "Get Service" request
     *
     * Reason to Call:
     * To find out details for a given postal service such as the dimension and weight limits and the available options.
     *
     * @param string $endpoint     Service endpoint (URL)
     * @param string $acceptHeader Accept header value
     *
     * @return \XLite\Core\CommonCell
     */
    protected function callGetService($endpoint, $acceptHeader)
    {
        $result = new \XLite\Core\CommonCell();

        try {

            $request = new \XLite\Core\HTTP\Request($endpoint);
            $request->requestTimeout = $this->requestTimeout;
            $request->verb = 'GET';
            $request->setHeader('Authorization', 'Basic ' . base64_encode(static::getCanadaPostConfig()->user . ':' . static::getCanadaPostConfig()->password));
            $request->setHeader('Accept', $acceptHeader);
            $request->setHeader('Accept-language', $this->getAcceptLanguage());

            if (static::isOnBehalfOfAMerchant()) {
                $request->setHeader('Platform-id', $this->getPlatformId());
            }

            $response = $request->sendRequest();

            if (
                isset($response->body)
                && !empty($response->body)
            ) {
                // Parse XML response to object
                $result = $this->parseResponseGetService($response->body);

            } else {

                // Register request error
                $result->errors = array(
                    $this->createErrorMessage(
                        'INTERNAL',
                        sprintf('Error while connecting to the Canada Post host (%s) during "Get Service" request', $endpoint)
                    )
                );
            }

            if (static::getCanadaPostConfig()->debug_enabled) {
                // Save debug log
                static::logApiCall($endpoint, 'Get Service', '', $response->body);
            }

        } catch (\Exception $e) {

            // Register exception error
            $errorMessage = $this->createErrorMessage($this->getCode(), $this->getMessage());

            $result->errors = array_merge((array) $result->errors, array($errorMessage));
        }

        return $result;
    }

    /**
     * Parse response of the "Get Service" call
     *
     * @param string $responseXml Response XML data
     *
     * @return \XLite\Core\CommonCell
     */
    protected function parseResponseGetService($responseXml)
    {
        $result = new \XLite\Core\CommonCell();

        // Parse XML document
        $xml = \XLite\Module\XC\CanadaPost\Core\XML::getInstance();

        $xmlParsed = $xml->parse($responseXml, $err);

        if (isset($xmlParsed['messages'])) {

            // Collect API error messages (using common method)
            $result->errors = $this->parseResponseErrors($xmlParsed);

        } else if (isset($xmlParsed['service'])) {

            // Collect returned data from "Get Service" call
            $result->service = $xml::convertParsedXmlDocument($xmlParsed['service']);
        }

        return $result;
    }

    // }}}
}
