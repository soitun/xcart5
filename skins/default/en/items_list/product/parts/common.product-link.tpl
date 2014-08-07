{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.table.customer.columns", weight="20")
 *}
<a 
  href="{buildURL(#product#,##,_ARRAY_(#product_id#^product.product_id,#category_id#^categoryId))}" 
  class="product-link">
  {product.name:h}
</a>
