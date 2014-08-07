{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add to Cart popup page: minicart box template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="add2cart_popup.minicart", weight="200")
 *}

<div class="minicart-box">

  <div class="cart-tray">
    <div class="tray-area">

      <div class="centered-tray-box">
        <div class="tray-status">{t(#_X_ items#,_ARRAY_(#count#^cart.countQuantity())):h}</div>
      </div>
    </div>
  </div>

  <list name="add2cart_popup.minicart.ext" />

</div>
