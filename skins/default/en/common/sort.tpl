{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Sort widget
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<widget class="\XLite\View\Form\Sort" name="sort_form" params="{getFormParams()}" />

<span>{t(#Sort by#)}</span>
<select name="sortCriterion">
  <option FOREACH="getParam(#sortCriterions#),key,name" value="{key}" selected="{isSortCriterionSelected(key)}">{name}</option>
</select>
<a href="{getSortOrderURL()}" class="{getSortOrderLinkClassName()}">{if:isSortOrderAsc()}&darr;{else:}&uarr;{end:}</a>

<widget name="sort_form" end />
<script type="text/javascript">
$(document).ready(
  function() {
    $('.sort-box').each(
      function() {
        new SortBoxController(this);
      }
    );
  }
);
</script>
