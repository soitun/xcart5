{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Cart coupons
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="coupons clearfix">

  <div IF="!getCoupons()" class="new more"><a href="#"><span>{t(#Have a discount coupon?#)}</span></a></div>
  <div IF="getCoupons()" class="new add"><a href="#"><span>{t(#Have more coupons?#)}</span></a></div>

  <div class="add-coupon clearfix" style="display: none;">
    <widget class="\XLite\Module\CDev\Coupons\View\Form\Customer\AddCoupon" name="addCoupon" />
      <widget class="XLite\View\FormField\Input\Text" fieldName="code" required="true" placeholder="{t(#Enter code#)}" maxlength="16" fieldOnly="true" label="{t(#Coupon code#)}" />
      <widget class="XLite\Module\CDev\Coupons\View\Button\AddCoupon" />
    <widget name="addCoupon" end />
  </div>

</div>
