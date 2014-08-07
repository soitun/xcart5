{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Images
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="comparison_table.header", weight="100")
 *}

<tr class="images">
  <td class="clear-list">
    <a href="{buildURL(#compare#,#clear#)}">{t(#Clear list#)}</a>
  </td>
  <td FOREACH="getProducts(),product">
    <a target="_blank"
      href="{buildURL(#product#,##,_ARRAY_(#product_id#^product.product_id))}"
      class="product-thumbnail">
        <widget
          class="\XLite\View\Image"
          image="{product.getImage()}"
          maxWidth="110"
          maxHeight="70"
          alt="{product.name}"
          className="photo" />
    </a>
    <a
      href="{buildURL(#compare#,#delete#,_ARRAY_(#product_id#^product.product_id))}"
      class="remove"
      title="{t(#Remove#)}"
      data-id="{product.product_id}">
      <img src="images/spacer.gif" alt="{t(#Remove#)}" />
    </a>
  </td>
</tr>
