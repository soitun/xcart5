{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Search total block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="search-total-wrapper">
  <ul>
    <li>{t(#Search total#)}:</li>
    <li FOREACH="getSearchTotals(),k,totals" class="amount">
      <span>{formatPrice(totals.orders_total, getSearchTotalCurrency(totals.currency_id))}{if:isNeedSearchTotalsSeparator(k)}, {end:}</span>
    </li>
  </ul>
</div>
