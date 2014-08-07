{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list (list variant)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<list name="itemsList.product.cart" />

<div class="products">

  <ul class="products-list" IF="getPageData()">
    <li FOREACH="getPageData(),product" class="product-cell">

      <table class="{getProductCellClass(product)}">
        <tr>
          <td class="product-photo">
            <div class="product-photo" style="width: {getIconWidth()}px;">
              <list name="photo" type="inherited" product="{product}" />
              <div IF="product.hasImage()">
                <list name="quicklook" type="inherited" product="{product}" />
              </div>
            </div>
          </td>
          <td class="product-info">
            <div class="product-info">
              <list name="info" type="inherited" product="{product}" />
              <div IF="!product.hasImage()">
                <list name="quicklook" type="inherited" product="{product}" />
              </div>
            </div>
          </td>
        </tr>
      </table>

    </li>
  </ul>

</div>
