{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Date type selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="table-label date-condition-label">
  <label>{t(#User activity#)}:</label>
</div>
<div class="star">&nbsp;</div>
<div class="table-value date-condition-value">
  <ul class="clearfix">
    <list name="profiles.search.dateTypes" />
  </ul>

  <input type="hidden" name="date_period" value="C" />

  <widget class="\XLite\View\FormField\Input\Text\DateRange" fieldName="dateRange" value="{getCondition(#dateRange#)}" fieldOnly="true" />
</div>

