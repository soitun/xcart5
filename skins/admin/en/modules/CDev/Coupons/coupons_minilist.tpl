{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Discount coupon subpanel
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.base.totals.modifier.name")
 *}

<ul IF="isDiscountCouponSubpanelVisible(surcharge)" class="discount-coupons-panel">
  <li FOREACH="getDiscountCoupons(),usedCoupon" title="{formatPrice(usedCoupon.getValue(),order.getCurrency())}">
    {if:usedCoupon.isDeleted()}
      {usedCoupon.getCode()}
    {else:}
      <a href="{buildUrl(#coupon#,##,_ARRAY_(#id#^usedCoupon.coupon.getId()))}">{usedCoupon.getCode()}</a>
    {end:}
  </li>
</ul>
