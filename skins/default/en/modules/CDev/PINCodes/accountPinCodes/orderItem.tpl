{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Account pin codes list order item 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="order-item" id="order-item-{item.getItemId()}">
<div class="order-item-title">
  <a href="{item.product.frontUrl}">{item.product.name}</a>
  <span class="amount"> x {item.getAmount()}</span>
</div>
<div class="pins-title">{t(#PIN#)}:</div> <div class="code" FOREACH="item.pinCodes,pin" id="pin-{pin.getId()}">{pin.code:h}</div>
</div>
