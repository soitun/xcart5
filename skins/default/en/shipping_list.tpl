{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shipping rates list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:isDisplaySelector()}
  <widget class="XLite\View\FormField\Select\ShippingMethod" disableSearch="true" fieldName="methodId" options="{getMethodsAsList()}" value="{selectedMethod.methodId}" fieldOnly="true" label="{t(#Shipping rates#)}" />
  <ul style="display:none" class="shipping-rates-data">
    {foreach:getRates(),rate}
      <li id="shippingMethod{getMethodId(rate)}">
        <span class="name" title="{getMethodName(rate):h}">{getMethodName(rate):h}<img src="images/spacer.gif" alt="" class="fade-a" /></span>
        <span class="value"><widget class="XLite\View\Surcharge" surcharge="{getTotalRate(rate)}" currency="{cart.getCurrency()}" /></span>
      </li>
    {end:}
  </ul>

{else:}
  <ul class="shipping-rates">
    <li FOREACH="getRates(),rate">
      <input type="radio" id="method{getMethodId(rate)}" name="methodId" value="{getMethodId(rate)}" checked="{isRateSelected(rate)}" />
      <label for="method{getMethodId(rate)}" title="{getMethodName(rate)}">{getMethodName(rate):h}<img src="images/spacer.gif" alt="" class="right-fade" /></label>
      <span class="value"><widget class="XLite\View\Surcharge" surcharge="{getTotalRate(rate)}" currency="{cart.getCurrency()}" /></span>
      <div class="clear"></div>
    </li>
  </ul>
{end:}
