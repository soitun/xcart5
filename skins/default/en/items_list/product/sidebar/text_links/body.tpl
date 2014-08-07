{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list (sidebar variant)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<list name="itemsList.product.cart" />

<ul class="list-body-sidebar products products-sidebar products-sidebar-text-links">

  <li FOREACH="getSideBarData(),i,product" class="product-cell box-product item {getAdditionalItemClass(productArrayPointer,productArraySize)}">
    <div class="{getProductCellClass(product)}">
      <list name="info" type="inherited" product="{product}" />
      <div class="clear"></div>
    </div>
  </li>

  <li IF="isShowMoreLink()">
    <a class="link" href="{getMoreLinkURL()}">{getMoreLinkText()}</a>
  </li>

</ul>
