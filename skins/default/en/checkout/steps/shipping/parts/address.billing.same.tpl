{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Billing address : save new checkbox
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="checkout.payment.address.after", weight="200")
 *}

<li class="same-address" IF="isSameAddressVisible()" >
  <input type="hidden" name="same_address" value="0" />
  <input id="same_address" type="checkbox" name="same_address" value="1" checked="{isSameAddress()}" />
  <label for="same_address">{t(#The same as shipping#)}</label>
</li>
