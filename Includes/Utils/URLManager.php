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

namespace Includes\Utils;

/**
 * URLManager
 *
 */
abstract class URLManager extends \Includes\Utils\AUtils
{
    /**
     * URL output type codes
     */
    const URL_OUTPUT_SHORT = 'short';
    const URL_OUTPUT_FULL  = 'full';

    /**
     * Remove trailing slashes from URL
     *
     * @param string $url URL to prepare
     *
     * @return string
     */
    public static function trimTrailingSlashes($url)
    {
        return \Includes\Utils\Converter::trimTrailingChars($url, '/');
    }
    
    /**
     * Return full URL for the resource
     *
     * @param string  $url             URL part to add           OPTIONAL
     * @param boolean $isSecure        Use HTTP or HTTPS         OPTIONAL
     * @param array   $params          URL parameters            OPTIONAL
     * @param string  $output          URL output type           OPTIONAL
     * @param boolean $isSession       Use session ID parameter  OPTIONAL
     * @param boolean $isProtoRelative Use protocol-relative URL OPTIONAL
     *
     * @return string
     */
    public static function getShopURL(
        $url = '',
        $isSecure = null,
        array $params = array(),
        $output = null,
        $isSession = null,
        $isProtoRelative = false
    ) {
        $url = trim($url);
        if (!preg_match('/^https?:\/\//Ss', $url)) {

            // We are using the protocol-relative URLs for resources
            $protocol = (true === $isSecure || static::isHTTPS()) ? 'https' : 'http';

            if (!isset($output)) {
                $output = static::URL_OUTPUT_FULL;
            }

            $hostDetails = static::getOptions('host_details');
            $host = $hostDetails[$protocol . '_host'];

            if ($host) {
                if ('/' != substr($url, 0, 1)) {
                    $url = $hostDetails['web_dir_wo_slash'] . '/' . $url;
                }

                $isSession = !isset($isSession)
                    ? (true === $isSecure && !static::isHTTPS())
                    : $isSession;

                if ($isSession) {
                    $session = \XLite\Core\Session::getInstance();
                    $url .= (false !== strpos($url, '?') ? '&' : '?') . $session->getName() . '=' . $session->getID();
                }

                foreach ($params as $name => $value) {
                    $url .= (false !== strpos($url, '?') ? '&' : '?') . $name . '=' . $value;
                }

                if (static::URL_OUTPUT_FULL == $output) {
                    if (substr($url, 0, 2) != '//') {
                        $url = '//' . $host . $url;
                    }

                    $url = ($isProtoRelative ? '' : ($protocol . ':')) . $url;
                }
            }
        }

        return $url;
    }

    /**
     * Return protocol-relative URL for the resource
     *
     * @param string  $url    URL part to add OPTIONAL
     * @param array   $params URL parameters            OPTIONAL
     * @param string  $output URL output type           OPTIONAL
     *
     * @return string
     */
    public static function getProtoRelativeShopURL(
        $url = '',
        array $params = array(),
        $output = null
    ) {
        if (!preg_match('/^https?:\/\//Ss', $url)) {
            if (!isset($output)) {
                $output = static::URL_OUTPUT_FULL;
            }
            $hostDetails = \Includes\Utils\ConfigParser::getOptions('host_details');
            $host        = $hostDetails[static::isHTTPS() ? 'https_host' : 'http_host'];
            if ($host) {
                if ('/' != substr($url, 0, 1)) {
                    $url = $hostDetails['web_dir_wo_slash'] . '/' . $url;
                }

                foreach ($params as $name => $value) {
                    $url .= (false !== strpos($url, '?') ? '&' : '?') . $name . '=' . $value;
                }

                if (static::URL_OUTPUT_FULL == $output) {
                    // We are using the protocol-relative URLs for resources
                    $url = '//' . $host . $url;
                }
            }
        }

        return $url;
    }

    /**
     * Check for secure connection
     *
     * @return boolean
     */
    public static function isHTTPS()
    {
        return (isset($_SERVER['HTTPS']) && ('on' === strtolower($_SERVER['HTTPS']) || '1' == $_SERVER['HTTPS']))
            || (isset($_SERVER['SERVER_PORT']) && '443' == $_SERVER['SERVER_PORT']);
    }

    /**
     * Return current URI
     *
     * @return string
     */
    public static function getSelfURI()
    {
        return isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null;
    }

    /**
     * Return current URL
     *
     * @return string
     */
    public static function getCurrentURL()
    {
        return 'http' . (static::isHTTPS() ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    /**
     * Check if provided string is a valid host part of URL
     *
     * @param string $str Host string
     *
     * @return boolean
     */
    public static function isValidURLHost($str)
    {
        $urlData = parse_url('http://' . $str . '/path');
        $host = $urlData['host'] . (isset($urlData['port']) ? ':' . $urlData['port'] : '');

        return ($host == $str);
    }

    /**
     * Get list of available shop domains
     *
     * @return array
     */
    public static function getShopDomains()
    {
        $result = array();

        $hostDetails = \Includes\Utils\ConfigParser::getOptions(array('host_details'));
        $result[] = !empty($hostDetails['http_host_orig']) ? $hostDetails['http_host_orig'] : $hostDetails['http_host'];
        $result[] = !empty($hostDetails['https_host_orig']) ? $hostDetails['https_host_orig'] : $hostDetails['https_host'];

        $domains = explode(',', $hostDetails['domains']);

        if (!empty($domains) && is_array($domains)) {
            foreach ($domains as $domain) {
                $result[] = $domain;
            }
        }

        return array_unique($result);
    }

    /**
     * Get options 
     * 
     * @param mixed $option Option
     *  
     * @return mixed
     */
    protected static function getOptions($option)
    {
        return \Includes\Utils\ConfigParser::getOptions($option);
    }
}
