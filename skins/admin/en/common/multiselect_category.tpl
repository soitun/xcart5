{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<select class="fixed-select" name="{formField}" multiple size="10" style="width:200px">
   <option value="" IF="allOption">{t(#All#)}</option>
   <option FOREACH="categories,k,v" value="{v.category_id:r}" selected="{v.isSelected(#category_id#,selectedCategory)}">{v.getStringPath():h}</option>
</select>
