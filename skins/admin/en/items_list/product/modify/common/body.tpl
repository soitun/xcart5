{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list (table variant)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<table class="data-table items-list">

  <tr>
    <list name="header" type="inherited" product="{product}" />
  </tr>

  <tr FOREACH="getPageData(),idx,product" class="{getRowClass(idx,##,#highlight#)}">
    <list name="columns" type="inherited" product="{product}" />
  </tr>

  <tr FOREACH="getViewList(#itemsList.product.modify.common.admin.items#),w">
    {w.display()}
  </tr>

</table>
