{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice items
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.base", weight="30")
 * @ListChild (list="invoice.base.items", weight="10")
 *}
<table style="border-color: #c4c4c4;border-width:1px;border-collapse: collapse;border-spacing: 0px;max-width: 700px;width: 100%;margin-top: 24px;">
  <tr style="border: 0px none;"><list name="invoice.items.head" /></tr>
  {foreach:order.getItems(),index,item}
  <tr style="border: 0px none;"><list name="invoice.item" item="{item}" /></tr>
  {end:}
  <tr style="border: 0px none;" FOREACH="getViewList(#invoice.items#),w">{w.display()}</tr>
</table>
