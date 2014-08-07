{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list (grid variant)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<list name="itemsList.product.cart" />

<div class="products">

  <table class="products-grid grid-{getParam(#gridColumns#)}-columns">
    {foreach:getProductRows(),row}
      <tr>
        {foreach:row,idx,product}
          <td IF="product" class="product-cell box-product">
            <list name="head" type="inherited" product="{product}" />
            <div class="{getProductCellClass(product)}">
              <list name="info" type="inherited" product="{product}" />
            </div>
            <list name="tail" type="inherited" product="{product}" />
          </td>
          <td IF="!product">&nbsp;</td>
        {end:}
      </tr>
    {end:}

  </table>

  <div class="products-grid show-more-link" IF="isShowMoreLink()">
    <a class="link" href="{getMoreLinkURL()}">{getMoreLinkText()}</a>
  </div>

</div>
