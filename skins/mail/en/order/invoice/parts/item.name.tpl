{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Name item cell
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.item", weight="10")
 *}
<td style="text-align: left;vertical-align: top;border-width:1px;border-collapse: collapse;border-spacing: 0px;border-style: solid;border-color: #c4c4c4;padding: 10px 20px;vertical-align: top;">
  <strong style="color: #000000;font-size: 18px;font-weight: bold;">{item.getName()}</strong>
  <ul IF="isViewListVisible(#invoice.item.name#,_ARRAY_(#item#^item))" style="list-style: none;padding-left:0;margin:0;color: #5a5a5a;">
  <list name="invoice.item.name" item="{item}" />
  </ul>
</td>