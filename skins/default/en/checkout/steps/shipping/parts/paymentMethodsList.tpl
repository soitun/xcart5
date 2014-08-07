{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Payment methods
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:getPaymentMethods()}

  <widget class="\XLite\View\Form\Checkout\PaymentMethod" name="paymentMethod" className="methods" />

    <ul class="payments">
      <li FOREACH="getPaymentMethods(),method">
        <input type="radio" id="pmethod{method.method_id}" name="methodId" value="{method.method_id}" {if:isPaymentSelected(method)} checked="{isPaymentSelected(method)}"{end:} {if:disabledSelector} disabled="disabled"{end:} />
        <label for="pmethod{method.method_id}"><widget template="{method.processor.getCheckoutTemplate(method)}" order="{getCart()}" method="{method}" /></label>
      </li>
    </ul>

  <widget name="paymentMethod" end />

{else:}
  <p class="payment-methods-not-defined">{t(#There's no payment method available#,_ARRAY_(#email#^config.Company.support_department)):h}</p>
{end:}
