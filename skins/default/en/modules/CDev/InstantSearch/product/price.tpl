{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product view template - price part
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="instant-search.product", weight="20")
 *}

<ul class="product-price">
  <li><span class="price product-price">{formatPrice(product.getDisplayPrice()):h}</span></li>
</ul>
