{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Checkout items totals block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="checkout.cart", weight="20")
 *}
<ul class="cart-sums">
  <li>
    <em>{t(#Subtotal#)}:</em>
    <span>{formatPrice(cart.getSubtotal(),cart.getCurrency())}</span>
  </li>
</ul>
