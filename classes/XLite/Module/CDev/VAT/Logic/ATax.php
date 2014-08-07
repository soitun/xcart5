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

namespace XLite\Module\CDev\VAT\Logic;

/**
 * Common tax business logic (base class for product and shipping tax logic)
 */
abstract class ATax extends \XLite\Logic\ALogic
{
    /**
     * Taxes (cache)
     *
     * @var array
     */
    protected $taxes;

    /**
     * Get taxes
     *
     * @param boolean $force Force renew taxes list flag OPTIONAL
     *
     * @return array
     */
    protected function getTaxes($force = false)
    {
        if (!isset($this->taxes) || $force) {
            $this->taxes = $this->defineTaxes();
        }

        return $this->taxes;
    }

    /**
     * Define taxes
     *
     * @return array
     */
    protected function defineTaxes()
    {
        return \XLite\Core\Database::getRepo('XLite\Module\CDev\VAT\Model\Tax')->findActive();
    }

    /**
     * Get zones list
     *
     * @return array
     */
    protected function getZonesList()
    {
        $address = $this->getAddress();

        $zones = $address ? \XLite\Core\Database::getRepo('XLite\Model\Zone')->findApplicableZones($address) : array();

        foreach ($zones as $i => $zone) {
            $zones[$i] = $zone->getZoneId();
        }

        return $zones;
    }

    /**
     * Get membership
     *
     * @return \XLite\Model\Membership
     */
    protected function getMembership()
    {
        return $this->getProfile()->getMembership();
    }

    /**
     * Get profile
     *
     * @return \XLite\Model\Profile
     */
    protected function getProfile()
    {
        $controller = \XLite::getController();

        $profile = $controller instanceOf \XLite\Controller\Customer\ACustomer
            ? $controller->getCart()->getProfile()
            : \XLite\Core\Auth::getInstance()->getProfile();

        return $profile ?: $this->getDefaultProfile();
    }

    /**
     * Get default profile if user is not authorized
     *
     * @return \XLite\Model\Profile
     */
    protected function getDefaultProfile()
    {
        return new \XLite\Model\Profile;
    }

    /**
     * Get address for zone calculator
     *
     * @return array
     */
    protected function getAddress()
    {
        $address = null;
        $addressObj = $this->getProfile()->getShippingAddress();
        if ($addressObj) {
            // Profile is exists
            $address = \XLite\Model\Shipping::prepareAddressData($addressObj);
        }

        if (!isset($address)) {

            // Anonymous address
            $config = \XLite\Core\Config::getInstance()->Shipping;
            $address = array(
                'address' => $config->anonymous_address,
                'city'    => $config->anonymous_city,
                'state'   => $config->anonymous_state,
                'zipcode' => $config->anonymous_zipcode,
                'country' => $config->anonymous_country,
            );
        }

        return $address;
    }

    // }}}
}
