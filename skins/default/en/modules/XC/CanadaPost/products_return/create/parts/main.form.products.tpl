{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Create return :: form :: products
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="capost_create_return.form", weight="100")
 *}

<div class="products">

  <table class="products-table" cellspacing="0">

    <tr>
      <list name="capost_create_return.form.captions" />
    </tr>

    <tr FOREACH="order.getItems(),item" class="product-cell product">
      <td FOREACH="getInheritedViewList(#capost_create_return.form.columns#,_ARRAY_(#item#^item)),column">{column.display()}</td>
    </tr>

  </table>

</div>
