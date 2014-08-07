{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product view template - in stock label
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="instant-search.product.stock-info", weight="10")
 *}

<span class="stock-level product-in-stock" IF="!product.inventory.isOutOfStock()">
  {t(#In stock#)}
  <span class="product-items-available">({t(#X items available#,_ARRAY_(#count#^product.inventory.getAvailableAmount()))})</span>
</span>
