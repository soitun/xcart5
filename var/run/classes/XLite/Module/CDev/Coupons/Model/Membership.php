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

namespace XLite\Module\CDev\Coupons\Model;

/**
 * Membership
 * @MappedSuperClass
 */
abstract class Membership extends \XLite\Model\MembershipAbstract implements \XLite\Base\IDecorator
{
    /**
     * Coupons
     *
     * @var   \Doctrine\Common\Collections\ArrayCollection
     *
     * @ManyToMany (targetEntity="XLite\Module\CDev\Coupons\Model\Coupon", mappedBy="memberships")
     */
    protected $coupons;

    /**
     * Add coupons
     *
     * @param XLite\Module\CDev\Coupons\Model\Coupon $coupons
     * @return Membership
     */
    public function addCoupons(\XLite\Module\CDev\Coupons\Model\Coupon $coupons)
    {
        $this->coupons[] = $coupons;
        return $this;
    }

    /**
     * Get coupons
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCoupons()
    {
        return $this->coupons;
    }
}