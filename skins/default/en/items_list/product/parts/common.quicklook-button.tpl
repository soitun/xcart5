{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Overlapping box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.grid.customer.info", weight="999")
 * @ListChild (list="itemsList.product.list.customer.quicklook", weight="999")
 * @ListChild (list="productBlock.info", weight="999")
 *}
<div IF="isQuickLookEnabled()" class="quicklook">
  <a
    href="{buildURL(#product#,##,_ARRAY_(#product_id#^product.product_id,#category_id#^categoryId))}"
    class="quicklook-link quicklook-link-{product.product_id} quicklook-link-category-{categoryId}">
    <div class="quicklook-view">&nbsp;</div>
  </a>
</div>
