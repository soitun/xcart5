{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product view template - quantity part
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="instant-search.product.add-to-cart", weight="10")
 *}

<span class="product-qty">
  {t(#Qty#)}: <widget class="\XLite\View\Product\QuantityBox" product="{getProduct()}" />
</span>
