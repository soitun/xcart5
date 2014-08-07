{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list (grid variant)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<list name="itemsList.product.cart" />

<div class="products">

  <ul class="products-grid grid-list" IF="getPageData()">
    <li FOREACH="getPageData(),product" class="product-cell box-product">
      <list name="head" type="inherited" product="{product}" />
      <div class="{getProductCellClass(product)}">
        <list name="info" type="inherited" product="{product}" />
      </div>
      <list name="tail" type="inherited" product="{product}" />
    </li>
    <li FOREACH="getNestedViewList(#items#),item" class="product-cell box-product">{item.display()}</li>
  </ul>

</div>
