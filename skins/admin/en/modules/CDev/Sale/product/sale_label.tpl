{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product element
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.products.search.cell.name", weight="10")
 * @ListChild (list="itemsList.product_selector.cell.name", weight="10")
 *}

<span
  id="product-sale-label-{entity.getProductId()}"
  class="product-name-sale-label{if:!participateSaleAdmin(entity)} product-name-sale-label-disabled{end:}">
  {t(#sale#)}
</span>
