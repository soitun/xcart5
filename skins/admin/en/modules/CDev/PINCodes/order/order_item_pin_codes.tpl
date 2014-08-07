{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order item pin codes
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div IF="!item.countPinCodes()=0" class="order-item-pin-codes">
  <div class="order-item order-item-{item.getItemId()}">

    <span IF="!item.isDeleted()" class="product-title">
      <a href="{buildUrl(#product#,##,_ARRAY_(#product_id#^item.product.id))}">{item.product.name:h}</a>
    </span>
    <span IF="item.isDeleted()" class="product-title">{item.product.name:h}</span>

    <span class="product-amount"> x {item.getAmount():h}</span>

  </div>
  <div class="pins-header">{t(#PIN#)}:</div>
  <div class="pin-code" FOREACH="item.getPinCodes(),pin" id="pin-{pin.getId()}">
    {pin.code:h}
  </div>
</div>
<div class="clear"></div>
