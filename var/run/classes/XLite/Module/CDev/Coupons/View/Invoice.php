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

namespace XLite\Module\CDev\Coupons\View;

/**
 * Invoice
 */
abstract class Invoice extends \XLite\View\InvoiceAbstract implements \XLite\Base\IDecorator
{
    /**
     * Discount coupons (local cahce)
     * 
     * @var   array
     */
    protected $discountCoupons;

    /**
     * Get a list of CSS files required to display the widget properly
     *
     * @return array
     */
    public function getCSSFiles()
    {
        $list = parent::getCSSFiles();

        $list[] = 'modules/CDev/Coupons/cart.css';

        return $list;
    }

    /**
     * Check - discount coupon subpanel is visible or not
     * 
     * @param array $surcharge Surcharge
     *  
     * @return boolean
     */
    protected function isDiscountCouponSubpanelVisible(array $surcharge)
    {
        return 'dcoupon' == strtolower($surcharge['code']) && $this->getDiscountCoupons();
    }

    /**
     * Get coupons
     *
     * @return array
     */
    protected function getDiscountCoupons()
    {
        if (!isset($this->discountCoupons)) {
            $this->discountCoupons = $this->getOrder()->getUsedCoupons()->toArray();
        }

        return $this->discountCoupons;
    }

    /**
     * Check discount coupon remove control is visible or not
     * 
     * @return boolean
     */
    protected function isDiscountCouponRemoveVisible()
    {
        return false;
    }
}

