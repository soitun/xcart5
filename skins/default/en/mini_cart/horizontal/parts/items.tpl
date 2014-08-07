{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Horizontal minicart items block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="minicart.horizontal.children", weight="10")
 *}
<div {printTagAttributes(getItemsContainerAttributes()):h}>

  <p class="title">
    <a href="{buildURL(#cart#)}">{t(#X items in bag#,_ARRAY_(#count#^cart.countQuantity()))}</a>
  </p>

  <ul>
    <li FOREACH="getItemsList(),item">
      <list name="minicart.horizontal.item" item="{item}" />
    </li>
  </ul>

  <p IF="isTruncated()" class="other-items"><a href="{buildURL(#cart#)}">{t(#Other items#)}</a></p>
   
   
  <p class="subtotal">
    <strong>{t(#Subtotal#)}:</strong>
    <span>{formatPrice(cart.getSubtotal(),cart.getCurrency())}</span>
  </p>
 

  <hr />

  <div class="buttons-row">
    <list name="minicart.horizontal.buttons" />
  </div>

</div>
