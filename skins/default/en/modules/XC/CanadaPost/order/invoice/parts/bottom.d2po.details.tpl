{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Canada Post post office details
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.bottom.d2po", weight="10")
 *}

<td class="capost-d2po">

  <strong>{t(#Delivery to Post Office#)}</strong>

  <ul class="address-section capost-d2po-section">
    <li class="address-field">{order.capostOffice.getName()}</li>
    <li class="address-street address-field">{order.capostOffice.getOfficeAddress()},</li>
    <li class="address-city address-field">{order.capostOffice.getCity()},</li>
    <li class="address-state address-field">{order.capostOffice.getProvince()},</li>
    <li class="address-zipcode address-field">{order.capostOffice.getPostalCode()}</li>
  </ul>

</td>

<td class="capost-d2po">&nbsp;</td>
