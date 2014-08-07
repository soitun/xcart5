{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Item name
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.grid.customer.info", weight="20")
 * @ListChild (list="itemsList.product.list.customer.info", weight="20")
 * @ListChild (list="itemsList.product.small_thumbnails.customer.details", weight="20")
 * @ListChild (list="itemsList.product.big_thumbnails.customer.info", weight="200")
 * @ListChild (list="itemsList.product.text_links.customer.info", weight="100")
 * @ListChild (list="productBlock.info", weight="200")
 *}
<h3 class="product-name">
  <a class="fn url" href="{buildURL(#product#,##,_ARRAY_(#product_id#^product.product_id,#category_id#^categoryId))}">
    {product.name:h}
  </a>
</h3>
