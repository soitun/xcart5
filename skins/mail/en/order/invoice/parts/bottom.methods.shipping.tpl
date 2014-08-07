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
<div style="position: absolute;bottom: 20px;font-size: 15px;">
  <strong style="color: #000;font-size: 20px;padding-bottom: 6px;display: block;font-weight: normal;">{t(#Shipping method#)}</strong>
  {if:getShippingModifier()&shippingModifier.getMethod()}
    {shippingModifier.method.getName():h}
  {elseif:order.getShippingMethodName()}
    {t(order.getShippingMethodName()):h}
  {else:}
    {t(#n/a#)}
  {end:}
</div>