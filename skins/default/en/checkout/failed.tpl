{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Checkout failed
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="order-success-box">
  <div class="order-success-panel">
    <p><widget template="{getFailedTemplate()}" /></p>
    <div class="buttons-row">
      <widget class="\XLite\View\Button\Link" label="Re-order" location="{getReorderURL()}" />
      &nbsp;&nbsp;
      <widget class="\XLite\View\Button\Link" label="Continue shopping" location="{getContinueURL()}" />
    </div>
  </div>
</div>
