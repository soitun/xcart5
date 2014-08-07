{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Top categories list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<ul class="menu menu-list{if:!isSubtree()} catalog-categories catalog-categories-path{end:}">
  {foreach:getCategories(),idx,_category}
    <li {displayItemClass(idx,_categoryArraySize,_category):h}>
      <a href="{buildURL(#category#,##,_ARRAY_(#category_id#^_category.category_id))}" {displayLinkClass(idx,_categoryArraySize,_category):h}>{_category.getName()}</a>
    </li>
  {end:}
  {foreach:getViewList(#topCategories.children#,_ARRAY_(#rootId#^getParam(#rootId#),#is_subtree#^getParam(#is_subtree#))),idx,w}
    <li {displayListItemClass(idx,wArraySize,w):h}>{w.display()}</li>
  {end:}
</ul>
