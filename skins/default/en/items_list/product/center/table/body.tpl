{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list (table variant)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="products">

  <table class="products-table" cellspacing="0" IF="getPageData()">
    <tr>
      <list name="captions" type="inherited" />
    </tr>
    <tr FOREACH="getPageData(),product" class="product-cell {getProductCellClass(product)}">
      <td FOREACH="getInheritedViewList(#columns#,_ARRAY_(#product#^product)),column">{column.display()}</td>
    </tr>
  </table>

  <list name="buttons" type="nested" />

</div>
