{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shopping cart item : quantity
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="cart.item", weight="50")
 *}
<td class="item-qty">
  {if:item.canChangeAmount()}
    <widget class="\XLite\View\Form\Cart\Item\Update" item="{item}" name="updateItem{item.getItemId()}" className="update-quantity" validationEngine />
      <div>
        <widget class="\XLite\View\Product\QuantityBox" product="{item.getProduct()}" fieldValue="{item.getAmount()}" isCartPage="{#1#}" orderItem="{item}" />
      </div>
    <widget name="updateItem{item.getItemId()}" end />
  {else:}
    <span class="non-valid-qty">{item.getAmount()}</span>
  {end:}
</td>
