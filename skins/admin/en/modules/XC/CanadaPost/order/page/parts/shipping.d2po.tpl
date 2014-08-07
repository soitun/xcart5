{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Canada Post delivery to post office section
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.shipping", weight="250")
 *}

<div IF="order.getCapostOffice()" class="address">

  <strong>{t(#Delivery to Post Office#)}</strong>

  <ul class="address-section shipping-address-section capost-d2po-section">

    <li class="address-field">
      <span class="address-field">{order.capostOffice.getName()}</span>
    </li>

    <li class="address-street address-field">
      <span class="address-field">{order.capostOffice.getOfficeAddress()}</span>
      <span class="address-comma">,</span>
    </li>

    <li class="address-city address-field">
      <span class="address-field">{order.capostOffice.getCity()}</span>
      <span class="address-comma">,</span>
    </li>

    <li class="address-state address-field">
      <span class="address-field">{order.capostOffice.getProvince()}</span>
      <span class="address-comma">,</span>
    </li>

    <li class="address-zipcode address-field">
      <span class="address-field">{order.capostOffice.getPostalCode()}</span>
    </li>

  </ul>

</div>
