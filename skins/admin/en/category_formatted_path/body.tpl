{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Category page template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<ul class="category-formatted-path">
  <li class="root-category">
    <a href="{buildURL(#categories#)}">{t(#Root categories#)}</a>
    <span class="delimiter">:</span>
  </li>
  <li FOREACH="getCategoryPath(),index,elem">
    <a href="{buildURL(#categories#,##,_ARRAY_(#id#^elem.getCategoryId()))}">{elem.getName()}</a>
    <span class="delimiter">:</span>
  </li>
</ul>
