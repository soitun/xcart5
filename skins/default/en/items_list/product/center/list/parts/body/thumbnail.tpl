{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Item thumbnail
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.list.customer.body", weight="20")
 *}

<td class="box-product">
  <div class="quick-look-cell">
  <div class="quick-look-cell-thumbnail">
    <list name="quick_look.thumbnail" type="nested" product="{product}" />
    <a 
      class="product-thumbnail" 
      href="{buildURL(#product#,##,_ARRAY_(#product_id#^product.product_id,#category_id#^categoryId))}">
      <widget 
        class="\XLite\View\Image" 
        image="{product.getImage()}" 
        maxWidth="{getIconWidth()}" 
        maxHeight="{getIconHeight()}" 
        alt="{product.name}" 
        className="photo" />
    </a>
  </div>
  </div>
</td>
