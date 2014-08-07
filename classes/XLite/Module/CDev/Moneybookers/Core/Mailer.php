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

namespace XLite\Module\CDev\Moneybookers\Core;

/**
 * Mailer
 */
class Mailer extends \XLite\Core\Mailer implements \XLite\Base\IDecorator
{
    const TYPE_MONEYBOOKERS_ACTIVATION = 'siteAdmin';
    
    /**
     * Send Moneybookers activation message
     *
     * @return void
     */
    public static function sendMoneybookersActivation()
    {
        // Register variables
        static::register(
            'platform_name',
            \XLite\Module\CDev\Moneybookers\Model\Payment\Processor\Moneybookers::getPlatformName()
        );
        $address = \XLite\Core\Auth::getInstance()->getProfile()->getBillingAddress();
        if ($address) {
            static::register('first_name', $address->getFirstName());
            static::register('last_name', $address->getLastName());

        } else {
            static::register('first_name', '');
            static::register('last_name', '');

        }
        static::register('email', \XLite\Core\Config::getInstance()->CDev->Moneybookers->email);
        static::register('id', \XLite\Core\Config::getInstance()->CDev->Moneybookers->id);
        static::register('url', \XLite::getInstance()->getShopURL());
        static::register('language', \XLite\Core\Session::getInstance()->getLanguage()->getCode());

        // Compose and send email
        static::compose(
            static::TYPE_MONEYBOOKERS_ACTIVATION,
            static::getSiteAdministratorMail(),
            'ecommerce@skrill.com',
            'modules/CDev/Moneybookers/activation'
        );
    }

}

