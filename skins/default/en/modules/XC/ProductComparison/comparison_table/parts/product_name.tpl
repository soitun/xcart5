{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="comparison_table.header_fixed", weight="100")
 *}

<tr class="names">
  <td><div>&nbsp;</div></td>
  <td FOREACH="getProducts(),product">
    <div>
      <a target="_blank" href="{buildURL(#product#,##,_ARRAY_(#product_id#^product.product_id))}"><span>{product.name}</span></a>
      <img src="images/spacer.gif" class="right-fade" alt="" />
    </div>
  </td>
</tr>
