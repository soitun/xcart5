{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Checkout shipping address form
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<widget class="\XLite\View\Form\Checkout\UpdateProfile" name="shippingAddress" className="address shipping-address" />
  <ul class="form shipping-address-form">
    <li FOREACH="getAddressFields(),fieldName,fieldData" class="item-{fieldName} {fieldData.additionalClass} clearfix">
      <widget
        class="{fieldData.class}"
        attributes="{getFieldAttributes(fieldName,fieldData)}"
        label="{fieldData.label}"
        fieldName="{getFieldFullName(fieldName)}"
        stateSelectorId="shippingaddress-state-id"
        stateInputId="shippingaddress-custom-state"
        value="{getFieldValue(fieldName)}"
        comment="{fieldData.comment}"
        wrapperClass="{fieldData.wrapperClass}"
        placeholder="{getFieldPlaceholder(fieldName)}"
        required="{fieldData.required}" />
      <list name="checkout.shipping.address.{fieldName}" address="{getAddressInfo()}" fieldName="{fieldName}" fieldData="{fieldData}" />
    </li>
    <list name="checkout.shipping.address" address="{getAddressInfo()}" />
  </ul>
<widget name="shippingAddress" end />

