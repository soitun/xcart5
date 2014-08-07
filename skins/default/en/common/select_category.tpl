{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Category selection dropdown box template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<select name="{getParam(#fieldName#)}" size="{getParam(#size#)}" {if:nonFixed} style="width:200pt" class="form-control" {else:}  class="FixedSelect form-control" {end:}  >
  <option value="" IF="getParam(#allOption#)">{t(#All#)}</option>
  <option value="" IF="getParam(#noneOption#)">{t(#None#)}</option>
  <option value="" IF="getParam(#rootOption#)" class="CenterBorder">{t(#Root level#)}</option>
	{foreach:getCategories(),key,category}
    <option
      IF="!getArrayField(category,#category_id#)=getParam(#currentCategoryId#)"
      value="{getArrayField(category,#category_id#)}"
      selected="{isCategorySelected(category)}">
        {getIndentationString(category,3,#-#)} {getCategoryName(category):h}
    </option>
  {end:}
  <option value="" IF="isDisplayNoCategories()">{t(#-- No categories --#)}</option>
</select>
