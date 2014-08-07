{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Name item cell
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.item", weight="10")
 *}
<td class="item">
  <a IF="item.getURL()" href="{item.getURL()}" class="item-name">{item.getName()}</a>
  <span IF="!item.getURL()" class="item-name">{item.getName()}</span>
  <span IF="!item.product.isPersistent()" class="deleted-product-note">({t(#deleted#)})</span>

  <ul IF="isViewListVisible(#invoice.item.name#,_ARRAY_(#item#^item))" class="subitem additional simple-list">
  <list name="invoice.item.name" item="{item}" />
  </ul>
</td>
