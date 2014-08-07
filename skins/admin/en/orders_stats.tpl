{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<p align="justify">{t(#This section displays order processing statistics#)}</p>

<br /><br />

<table class="data-table order-statistics">

  <tr class="TableHead">
    <th class="title"><widget class="XLite\View\Order\Statistics\CurrencySelector" /></th>
    <th FOREACH="getStatsColumns(),c">{t(getColumnTitle(c))}</th>
  </tr>

  <tr FOREACH="getStats(),idx,row" class="dialog-box{if:isTotalsRow(idx)} totals{end:}">
    <td class="title">{t(getRowTitle(idx))}</td>
    <td FOREACH="row,idx1,val">
      {if:isTotalsRow(idx)}{formatPrice(val,getCurrency())}{else:}{val}{end:}
    </td>
  </tr>

</table>
