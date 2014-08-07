{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list sorting control
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.grid.customer.header")
 * @ListChild (list="itemsList.product.list.customer.header")
 * @ListChild (list="itemsList.product.table.customer.header")
 *}

<div IF="isSortBySelectorVisible()" class="sort-box">

  <ul class="display-sort sort-crit grid-list" id="{getSortWidgetId(true)}">
  {foreach:sortByModes,key,name}
  <li class="list-type-grid {if:isSortByModeSelected(key)} selected{end:}">
    <a data-sort-by="{key}" data-sort-order="{getSortOrderToChange(key)}" href="{getActionURL(_ARRAY_(#sortBy#^key,#sortOrder#^getSortOrderToChange()))}">
      {t(name)}<i class="sort-arrow {getSortArrowClassCSS(key)}"></i>
    </a>
  </li>
  {end:}
  </ul>

</div>
