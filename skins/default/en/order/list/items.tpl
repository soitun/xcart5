{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order items short list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<table cellspacing="0" class="order-list-items">
  <tr FOREACH="getItems(),i,item">

    <td class="image">
      <widget class="\XLite\View\Image" image="{item.getImage()}" alt="{item.getName()}" maxWidth="40" maxHeight="40" centerImage="0" />
    </td>

    <td>
      <ul class="name-qty">
        <li class="name">
          <a IF="!item.isDeleted()" href="{item.getURL()}">{item.name}</a>
          <span IF="item.isDeleted()">{item.name}</span>
        </li>
        <li class="qty">{t(#Qty#)}: <span class="quantity">{item.amount}</span></li>
      </ul>
    </td>

  </tr>

</table>

<list name="orders.children.view_all_items_link" />
