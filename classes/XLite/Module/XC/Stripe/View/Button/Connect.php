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

namespace XLite\Module\XC\Stripe\View\Button;

/**
 * Connect 
 */
class Connect extends \XLite\View\Button\Link
{

    /**
     * Get CSS files 
     * 
     * @return array
     */
    public function getCSSFiles()
    {
        $list = parent::getCSSFiles();
    
        $list[] = 'modules/XC/Stripe/button.css';

        return $list;
    }

    /**
     * Get default label
     *
     * @return string
     */
    protected function getDefaultLabel()
    {
        return 'Connect with Stripe';
    }

    /**
     * We make the full location path for the provided URL
     *
     * @return string
     */
    protected function getLocationURL()
    {
        $currency = \XLite::getInstance()->getCurrency()
            ? strtolower(\XLite::getInstance()->getCurrency()->getCode())
            : 'usd';
        $company = \XLite\Core\Config::getInstance()->Company;
        $oauth = \XLite\Module\XC\Stripe\Core\OAuth::getInstance();

        return 'https://connect.stripe.com/oauth/authorize'
            . '?response_type=code'
            . '&client_id=' . $oauth->getClientId()
            . '&scope=read_write'
            . '&state=' . $oauth->generateURLState()
            . '&stripe_landing=register'
            . '&stripe_user[email]=' . \XLite\Core\Auth::getInstance()->getProfile()->getLogin()
            . '&stripe_user[url]=' . \XLite::getInstance()->getShopUrl(\Xlite\Core\Converter::buildUrl())
            . '&stripe_user[country]=' . $company->location_country
            . '&stripe_user[street_address]=' . $company->location_address
            . '&stripe_user[city]=' . $company->location_city
            . '&stripe_user[zip]=' . $company->location_zipcode
            . '&stripe_user[business_name]=' . $company->company_name
            . '&stripe_user[currency]=' . $currency;
    }

    /**
     * Get default style
     *
     * @return string
     */
    protected function getDefaultStyle()
    {
        return trim(parent::getDefaultStyle() . ' stripe-connect');
    }

}

