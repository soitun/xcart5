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

namespace XLite\Module\XC\CanadaPost\Core;

/**
 * Mailer
 */
abstract class Mailer extends \XLite\Module\CDev\Moneybookers\Core\Mailer implements \XLite\Base\IDecorator
{
    /**
     * FROM type
     */
    const TYPE_PRODUCTS_RETURN_APPROVED = 'ordersDep';
    const TYPE_PRODUCTS_RETURN_REJECTED = 'ordersDep';

    /**
     * Send mail notification to customer that his products return has been approved
     *
     * @param \XLite\Module\XC\CanadaPost\Model\ProductsReturn $return Canada Post products return model
     *
     * @return void
     */
    public static function sendProductsReturnApproved(\XLite\Module\XC\CanadaPost\Model\ProductsReturn $return)
    {
        static::setMailInterface(\XLite::CUSTOMER_INTERFACE);

        if (
            $return->getOrder() 
            && $return->getOrder()->getProfile()
        ) {
            static::register('productsReturn', $return);

            static::register('notes', nl2br($return->getAdminNotes(), false));

            static::compose(
                static::TYPE_PRODUCTS_RETURN_APPROVED,
                static::getOrdersDepartmentMail(),
                $return->getOrder()->getProfile()->getLogin(),
                'modules/XC/CanadaPost/return_approved',
                array(),
                true,
                \XLite::CUSTOMER_INTERFACE,
                static::getMailer()->getLanguageCode(\XLite::CUSTOMER_INTERFACE, $return->getOrder()->getProfile()->getLanguage())
            );
        }
    }

    /**
     * Send mail notification to customer that his products return has been rejected
     *
     * @param \XLite\Module\XC\CanadaPost\Model\ProductsReturn $return Canada Post products return model
     *
     * @return void
     */
    public static function sendProductsReturnRejected(\XLite\Module\XC\CanadaPost\Model\ProductsReturn $return)
    {
        static::setMailInterface(\XLite::CUSTOMER_INTERFACE);

        if (
            $return->getOrder() 
            && $return->getOrder()->getProfile()
        ) {
            static::register('productsReturn', $return);

            static::register('notes', nl2br($return->getAdminNotes(), false));

            static::compose(
                static::TYPE_PRODUCTS_RETURN_REJECTED,
                static::getOrdersDepartmentMail(),
                $return->getOrder()->getProfile()->getLogin(),
                'modules/XC/CanadaPost/return_rejected',
                array(),
                true,
                \XLite::CUSTOMER_INTERFACE,
                static::getMailer()->getLanguageCode(\XLite::CUSTOMER_INTERFACE, $return->getOrder()->getProfile()->getLanguage())
            );
        }
    }
}
