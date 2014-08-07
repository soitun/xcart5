{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice items
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.items.wrapper", weight="10")
 *}
<table cellspacing="0" class="items">
  <tr><list name="order.items.head" /></tr>
  {foreach:order.getItems(),index,item}
  <tr><list name="order.item" item="{item}" /></tr>
  {end:}
  <tr FOREACH="getViewList(#order.items#),w">{w.display()}</tr>
</table>
