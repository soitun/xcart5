{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Item thumbnail
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.grid.customer.info.photo", weight="10")
 * @ListChild (list="itemsList.product.small_thumbnails.customer.info.photo", weight="10")
 * @ListChild (list="itemsList.product.big_thumbnails.customer.info.photo", weight="10")
 * @ListChild (list="productBlock.info.photo", weight="100")
 *}
<a
  href="{buildURL(#product#,##,_ARRAY_(#product_id#^product.product_id,#category_id#^categoryId))}"
  class="product-thumbnail">
  <widget
    class="\XLite\View\Image"
    image="{product.getImage()}"
    maxWidth="{getIconWidth()}"
    maxHeight="{getIconHeight()}"
    alt="{getIconAlt(product)}"
    className="photo" />
</a>
