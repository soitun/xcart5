{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Subcategories list (list style)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<ul class="subcategory-view-list subcategory-list grid-list" IF="category.getSubcategories()">
  {foreach:category.getSubcategories(),subcategory}
  <li IF="subcategory.hasAvailableMembership()">
    <a href="{buildURL(#category#,##,_ARRAY_(#category_id#^subcategory.category_id))}" class="subcategory-name">{subcategory.name}</a>
  </li>
  {end:}
  <li FOREACH="getNestedViewList(#children#),item">{item.display()}</li>
</ul>
<list name="subcategories.base" />
