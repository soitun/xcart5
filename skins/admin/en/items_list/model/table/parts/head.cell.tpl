{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Head cell
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:column.headTemplate}
  <widget template="{column.headTemplate}" column="{column}" />
{else:}
{if:column.sort}
  <a
    href="{buildURL(getTarget(),##,_ARRAY_(#sortBy#^column.sort,#sortOrder#^getSortDirectionNext(column)))}"
    data-sort="{column.sort}"
    data-direction="{getSortOrder()}"
    class="{getSortLinkClass(column)}">{column.name}</a>
  {if:isColumnSorted(column)}
  <span IF="#desc#=getSortOrder()" class="dir desc-order">&uarr;</span>
  <span IF="#asc#=getSortOrder()" class="dir asc-order">&darr;</span>
  {end:}
{else:}
  {column.name}
{end:}
  <div class="column-header-help" IF="column.headHelp">
    <widget
      class="\XLite\View\Tooltip"
      id="menu-links-help-text"
      text="{column.headHelp:h}"
      isImageTag="true"
      className="help-small-icon" />
  </div>
{end:}
<div IF="{column.subheader}" class="subheader">{column.subheader}</div>
<list type="inherited" name="{getCellListNamePart(#head#,column)}" column="{column}" />
<input IF="column.columnSelector" type="checkbox" class="selectAll not-significant" />
