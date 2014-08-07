{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules main description section list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.module.install.columns.module-description-section", weight="0")
 *}

<div class="module-tags" IF="module.getTags()">
<ul class="module-tags-list">
  <li FOREACH="module.getTags(),value">
    <a href="{buildURL(#addons_list_marketplace#,##,_ARRAY_(#tag#^value))}">{getTagName(value)}<div class="circle"></div></a>
  </li>
</ul>
</div>
