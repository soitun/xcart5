{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * PayPal Express Checkout button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="cart-checkout">
  <button type="button" onclick="javascript: {getJSCode():h}" class="{getClass()}"{if:getId()} id="{getId()}"{end:} {if:isDisabled()} disabled="disabled" {end:}>
  <img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" align="left" style="margin-right:7px;">
  </button>
</div>
