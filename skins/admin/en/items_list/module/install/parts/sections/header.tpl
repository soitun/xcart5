{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="marketplace.top-controls", weight="350")
 *}

<div IF="isVisibleAddonFilters()" class="addons-filters">

  <div class="addons-selectors">

  <form name="addons-filter" method="GET" action="{buildURL()}">
  <widget class="\XLite\View\FormField\Input\FormId" />
  <input FOREACH="getURLParams(),name,value" type="hidden" name="{name}" value="{value}" />

  <div class="addons-sort-box combine-selector">
    <widget
      class="\XLite\View\FormField\Select\AddonsSort"
      fieldId="addons-sort"
      fieldName="addonsSort"
      disableSearch="true"
      options="{getSortOptionsForSelector()}"
      value="{getSortOptionsValueForSelector()}"
      attributes="{_ARRAY_(#data-classes#^#addons-sort#,#data-height#^#100%#)}"
      label="{t(#Sort by#)}"
    />
  </div>

  <div class="tag-filter-box combine-selector">
    <widget
      class="\XLite\View\FormField\Select\AddonsSort"
      fieldId="tag-filter"
      fieldName="tag"
      options="{getTagOptionsForSelector()}"
      value="{getTagOptionsValueForSelector()}"
      attributes="{_ARRAY_(#data-classes#^#tag-filter#,#data-height#^#100%#)}"
      label="{t(#Tags#)}"
    />
  </div>

  </form>

  </div>

  <list name="marketplace.addons-filters" />

  <div class="clear"></div>

</div>
