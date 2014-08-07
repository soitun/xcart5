{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Checkout : payment step : selected state : address
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="substep step-billing-address {if:isFormVisible()}address-visible{else:}address-invisible{end:}">
  <h3><span class="bullet">{getSubstepNumber(#billingAddress#)}</span>{t(#Billing address#)}</h3>
 
 <a IF="isDisplayAddressButton()" href="{buildURL(#select_address#,##,_ARRAY_(#atype#^#b#))}" class="address-book">{t(#Address book#)}</a>
 <widget template="checkout/steps/shipping/parts/address.billing.tpl" />
</div>
