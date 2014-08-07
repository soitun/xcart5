{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice shipping methods
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.bottom.address.shipping", weight="20")
 *}
<div class="method-box">
  <strong class="method-title">{t(#Shipping method#)}</strong>
  {if:getShippingModifier()&shippingModifier.getMethod()}
    {shippingModifier.method.getName():h}
  {elseif:order.getShippingMethodName()}
    {t(order.getShippingMethodName()):h}
  {else:}
    {t(#n/a#)}
  {end:}

  <div class="tracking-number-box" IF="!order.trackingNumbers.isEmpty()">
    <strong class="method-title">{t(#Tracking numbers#)}</strong>
    <ul class="tracking-number-list">
      <li FOREACH="order.trackingNumbers,number">{number.getValue()}</li>
    </ul>
  </div>
</div>
