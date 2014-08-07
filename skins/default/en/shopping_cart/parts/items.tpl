{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shopping cart items block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="cart.children", weight="10")
 * @ListChild (list="checkout.cart", weight="10")
 *}
<table class="selected-products" cellspacing="0">

  <tbody class="items">
    <tr class="selected-product" FOREACH="cart.getItems(),item">
      <list name="cart.item" item="{item}" />
    </tr>
  </tbody>

  <tbody class="additional-items">
    <tr class="selected-product additional-item" FOREACH="getViewList(#cart.items#),w">
      {w.display()}
    </tr>
  </tbody>

</table>
