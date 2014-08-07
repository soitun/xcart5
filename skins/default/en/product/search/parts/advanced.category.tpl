{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Search by category
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @listChild (list="products.search.conditions.advanced", weight="200")
 *}

<tr>
  <td class="option-name title-category">{t(#Category#)}:</td>
  <td><widget class="\XLite\View\CategorySelect" fieldName="categoryId" selectedCategoryIds="{_ARRAY_(getCondition(#categoryId#))}" allOption /></td>
</tr>
