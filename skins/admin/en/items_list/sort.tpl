{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="sort-order">
  <div IF="isSortByModeSelected(sortByColumn)" class="part order-by">
    <a
      class="{if:isSortOrderAsc()} asc-order{else:} desc-order{end:}"
      href="{getActionURL(_ARRAY_(%static::PARAM_SORT_ORDER%^getSortOrderToChange()))}">
      <span class="selected">{title:h}</span>
    </a>
  </div>
  <div IF="!isSortByModeSelected(sortByColumn)" class="part sort-crit">
    <a class="{sortByColumn}" href="{getActionURL(_ARRAY_(%static::PARAM_SORT_BY%^sortByColumn))}">{title:h}</a>
  </div>
</div>
