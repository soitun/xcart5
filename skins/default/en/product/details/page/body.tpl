{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product details
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="product-details product-info-{product.getProductId()} box-product">
  <widget class="\XLite\View\Form\Product\AddToCart" name="add_to_cart" product="{product}" className="product-details" validationEngine />
    <list name="product.details.page" />
  <widget name="add_to_cart" end />
</div>
