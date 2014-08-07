{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order's shipping method
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.shipping", weight="100")
 *}

<div class="method">
  <strong>{t(#Shipping method#)}:</strong>
  {if:getShippingModifier()&shippingModifier.getMethod()}{/if}
    <span>{shippingModifier.method.getName():h} ({formatPrice(getShippingCost(),order.getCurrency())})</span>
  {elseif:order.getShippingMethodName()}
    <span>{t(order.getShippingMethodName()):h} ({formatPrice(getShippingCost(),order.getCurrency())})</span>
  {else:}
    <span>{t(#n/a#)}</span>
  {end:}
</div>
