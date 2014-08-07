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

namespace XLite\Module\XC\Stripe\View;

/**
 * Payment widget
 */
class Payment extends \XLite\View\AView
{
    /**
     * Return widget default template
     *
     * @return string
     */
    protected function getDefaultTemplate()
    {
        return 'modules/XC/Stripe/checkout.tpl';
    }

    /**
     * Get data atttributes 
     * 
     * @return array
     */
    protected function getDataAtttributes()
    {
        $total = $this->getCart()->getCurrency()->roundValue(
            $this->getCart()->getFirstOpenPaymentTransaction()->getValue()
        );

        $method = $this->getCart()->getPaymentMethod();
        $prefix = $method->getProcessor()->isTestMode($method) ? 'Test' : 'Live';
        $description = static::t(
            'X items ($)',
            array(
                'count' => $this->getCart()->countQuantity(),
                'total' => $this->formatPrice($total, $this->getCart()->getCurrency())
            )
        );

        $data = array(
            'data-key'         => $this->getCart()->getPaymentMethod()->getSetting('publishKey' . $prefix),
            'data-name'        => \XLite\Core\Config::getInstance()->Company->company_name,
            'data-description' => $description,
            'data-total'       => $this->getCart()->getCurrency()->roundValueAsInteger($total),
            'data-currency'    => $this->getCart()->getCurrency()->getCode(),
        );

        if (\XLite\Core\Session::getInstance()->checkoutEmail) {
            $data['data-email'] = \XLite\Core\Session::getInstance()->checkoutEmail;

        } elseif ($this->getCart()->getProfile()) {
            $data['data-email'] = $this->getCart()->getProfile()->getLogin();
        }

        return $data;
    }
}

