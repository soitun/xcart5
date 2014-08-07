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

namespace XLite\Module\CDev\Paypal;

/**
 * Paypal module
 */
abstract class Main extends \XLite\Module\AModule
{
    /**
     * Paypal methods service names
     */
    const PP_METHOD_PPA = 'PaypalAdvanced';
    const PP_METHOD_PFL = 'PayflowLink';
    const PP_METHOD_EC  = 'ExpressCheckout';
    const PP_METHOD_PPS = 'PaypalWPSUS';


    /**
     * Author name
     *
     * @return string
     */
    public static function getAuthorName()
    {
        return 'X-Cart team';
    }

    /**
     * Module name
     *
     * @return string
     */
    public static function getModuleName()
    {
        return 'PayPal US';
    }

    /**
     * Module major version
     *
     * @return string
     */
    public static function getMajorVersion()
    {
        return '5.1';
    }


    /**
     * Module version
     *
     * @return string
     */
    public static function getMinorVersion()
    {
        return '3';
    }

    /**
     * Module description
     *
     * @return string
     */
    public static function getDescription()
    {
        return 'Enables taking payments for your online store via PayPal services (for US merchants).';
    }

    /**
     * Determines if we need to show settings form link
     *
     * @return boolean
     */
    public static function showSettingsForm()
    {
        return false;
    }

    /**
     * Add record to the module log file
     *
     * @param string $message Text message OPTIONAL
     * @param mixed  $data    Data (can be any type) OPTIONAL
     *
     * @return void
     */
    public static function addLog($message = null, $data = null)
    {
        if ($message && $data) {
            $msg = array(
                'message' => $message,
                'data'    => $data,
            );

        } else {
            $msg = ($message ?: ($data ?: null));
        }

        if (!is_string($msg)) {
            $msg = var_export($msg, true);
        }

        \XLite\Logger::logCustom(
            self::getModuleName(),
            $msg
        );
    }

    /**
     * Returns true if ExpressCheckout payment is enabled 
     *
     * @param \XLite\Model\Cart $order Cart object OPTIONAL
     *
     * @return boolean
     */
    public static function isExpressCheckoutEnabled($order = null)
    {
        static $result;

        $index = isset($order) ? 1 : 0;

        if (!isset($result[$index])) {
            $paymentMethod = \XLite\Core\Database::getRepo('XLite\Model\Payment\Method')
                ->findOneBy(
                    array(
                        'service_name' => 'ExpressCheckout',
                        'enabled'      => true
                    )
                );
            $result[$index] = !empty($paymentMethod) && $paymentMethod->isEnabled();

            if ($order && $result[$index]) {
                $result[$index] = $paymentMethod->getProcessor()->isApplicable($order, $paymentMethod);
            }
        }

        return $result[$index];
    }

    /**
     * Return list of mutually exclusive modules
     *
     * @return array
     */
    public static function getMutualModulesList()
    {
        $list = parent::getMutualModulesList();
        $list[] = 'CDev\PaypalWPS';

        return $list;
    }
}
