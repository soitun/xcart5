{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product view template - price part
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="instant-search.product", weight="30")
 *}

<div class="shade-base" if="!product.inventory.isOutOfStock()">

  <widget class="\XLite\View\Form\Product\AddToCart" name="add_to_cart_{product.getProductId()}" product="{getProduct()}" className="product-details instant-search-product-details" validationEngine />

    <list name="instant-search.product.add-to-cart" />

  <widget name="add_to_cart_{product.getProductId()}" end />

</div>
