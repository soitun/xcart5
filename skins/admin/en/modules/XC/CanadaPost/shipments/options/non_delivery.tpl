{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Option :: Non-delivery handling
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget
  class="\XLite\Module\XC\CanadaPost\View\FormField\Select\NonDeliveryType"
  fieldId="opt-non-delivery-{parcelIdx}"
  fieldName="parcelsData[{parcel.getId()}][optNonDelivery]"
  fieldOnly="true"
  isMandatory="{optionClass.mandatory}"
  allowedOptions="{optionClass.allowedOptions}"
  value="{parcel.getOptNonDelivery()}" />
