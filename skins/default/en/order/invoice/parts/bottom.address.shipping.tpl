{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice shipping address
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.bottom.address.shipping", weight="20")
 *}
<strong class="title">{t(#Shipping address#)}</strong>

<ul class="address-section shipping-address-section">
  <li FOREACH="getAddressSectionData(saddress),idx,field" class="{field.css_class} address-field">
    <span class="address-title">{t(field.title)}:</span>
    <span class="address-field">{field.value}</span>
    <span class="address-comma">,</span>
  </li>
</ul>
