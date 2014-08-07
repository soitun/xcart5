{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Checkout : shipping step : selected state : methods
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="checkout.shipping.selected.sub.payment", weight="200")
 *}
<div class="substep step-shipping-methods" IF="isShippingAvailable()">
  <h3><span class="bullet">{getSubstepNumber(#shippingMethods#)}</span>{t(#Delivery methods#)}</h3>
  <widget class="\XLite\View\Checkout\ShippingMethodsList" />
</div>
