{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Item buttons
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="productBlock.info", weight="400")
 *}
<widget
  IF="product.isAvailable()"
  class="\XLite\View\Form\Product\AddToCart"
  name="add_to_cart_{product.product_id}"
  product="{product}"
  className="add-to-cart" />
  <widget class="\XLite\View\Button\Submit" style="product-add2cart" label="Add to cart" />
<widget name="add_to_cart_{product.product_id}" end />
