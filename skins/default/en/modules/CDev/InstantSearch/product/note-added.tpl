{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product view template - added to cart note
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="instant-search.product", weight="50")
 *}

<p class="product-added-note" IF="isProductAdded()">
  {t(#This product has been added to your bag#,_ARRAY_(#href#^buildURL(#cart#))):h}
</p>
