{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order summary mini informer (for dashboard)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="orders-stats">
  <div class="tab-content-title">{t(#Accepted orders#)}</div>
  <div class="value" IF="!isEmptyStats()">{tab.orders.value}<span class="{getDeltaType(tab,#orders#)}"></span></div>
  <div class="value" IF="isEmptyStats()">&mdash;</div>
  <div class="prev" IF="isDisplayPrevValue(tab)">{getPrevValue(tab,#orders#)}</div>
</div>

<div class="revenue-stats">
  <div class="tab-content-title">{t(#Revenue#)}</div>
  <div class="value">{formatValue(tab.revenue.value)}<span class="{getDeltaType(tab,#revenue#)}"></span></div>
  <div class="prev" IF="isDisplayPrevValue(tab)">{getPrevValue(tab,#revenue#)}</div>
</div>

<div class="lifetime-stats" IF="isLifetimeTab(tab)">{t(#Sale statistics from the opening of the store#)}</div>
<div class="no-orders" IF="isEmptyStats()">{t(#No order have been placed yet#)}</div>
