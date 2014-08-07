{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list display mode selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.grid.customer.header", weight="20")
 * @ListChild (list="itemsList.product.list.customer.header", weight="20")
 * @ListChild (list="itemsList.product.table.customer.header", weight="20")
 *}

<ul class="display-modes grid-list" IF="isDisplayModeSelectorVisible()">
  <li FOREACH="displayModes,key,name" class="{getDisplayModeLinkClassName(key)}">
    <a href="{getActionURL(_ARRAY_(#displayMode#^key))}" class="{key}" title="{t(name)}">
      <i class="fa {getDisplayModeCSS(key)}"></i>
      <span class="text">{t(name)}</span>
    </a>
  </li>
</ul>
