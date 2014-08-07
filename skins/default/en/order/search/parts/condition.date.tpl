{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Orders search Order ID condition
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="orders.search.conditions", weight="20")
 *}
<tr class="date">
  <td class="title">{t(#Date range#)}:</td>
  <td>

    <widget class="\XLite\View\DatePicker" field="startDate" value="{getCondition(#startDate#)}" />
    &ndash;
    <widget class="\XLite\View\DatePicker" field="endDate" value="{getCondition(#endDate#)}" />

    <br />

{* TODO Restore

    <ul class="date-buttons">
      <li><a href="javascript:void(0);" onclick="javascript:">{t(#This week#)}</a></li>
      <li><a href="javascript:void(0);" onclick="javascript:">{t(#This month#)}</a></li>
      <li><a href="javascript:void(0);" onclick="javascript:">{t(#This year#)}</a></li>
    </ul>

*}

  </td>
</tr>
