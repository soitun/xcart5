{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * 'Back from payment' popup
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="back-from-payment">
  <h3>{t(#Please choose the appropriate action#)}</h3>
  <widget class="\XLite\View\Button\Link" label="Checkout" jsCode="popup.close()" style="regular-main-button" />
  <span class="or">{t(#or#)}</span>
  <widget class="\XLite\View\Button\Link" label="View cart" location="{buildURL(#cart#)}" />
</div>
