{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shopping cart box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.cart")
 *}

<div class="cart-tray cart-tray-box">
  <div class="tray-area">

    <div class="centered-tray-box">

    <div class="drop-here tray-status">{t(#Drop items here to shop#)}</div>

    <div class="dropped-here tray-status">{t(#Product has been added to cart#)}</div>

    <div class="product-added tray-status">
      <widget class="\XLite\View\Button\Link" label="Checkout" location="{buildURL(#checkout#)}" />
    </div>

    <div class="progress-bar">
      <div class="wait-progress">
        <div></div>
      </div>
    </div>

    </div>

  </div>
</div>
<div class="preload-cart-tray"></div>
