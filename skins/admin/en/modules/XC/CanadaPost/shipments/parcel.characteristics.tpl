{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Parcel characteristics
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<h3>{t(#Parcel characteristics#)}</h3>

<table class="capost-parcel-options">

  <tr>
    <td>{t(#Total items weight#)}:</td>
    <td>
      {parcel.getWeightInKg(1)} {t(#kg#)}
      <span IF="parcel.isOverWeight()" class="error-message">({t(#warning: parcel is overweight#)})</span>
    </td>
  </tr>

  <tr>
    <td>{t(#Box maximum weight#)}:</td>
    <td>{parcel.getBoxWeightInKg(1)} {t(#kg#)}</td>
  </tr>

  <tr>
    <td>{t(#Dimensions (cm)#)}:<br />({t(#Length#)} x {t(#Width#)} x {t(#Height#)})</td>
    <td class="parcel-dimensions">
      <widget 
        class="\XLite\Module\XC\CanadaPost\View\FormField\Input\Text\Dimension"
        fieldName="parcelsData[{parcel.getId()}][boxLength]"
        fieldOnly="true"
        value="{parcel.getBoxLength()}" />
      <widget 
        class="\XLite\Module\XC\CanadaPost\View\FormField\Input\Text\Dimension"
        fieldName="parcelsData[{parcel.getId()}][boxWidth]"
        fieldOnly="true"
        value="{parcel.getBoxWidth()}" />
      <widget 
        class="\XLite\Module\XC\CanadaPost\View\FormField\Input\Text\Dimension"
        fieldName="parcelsData[{parcel.getId()}][boxHeight]"
        fieldOnly="true"
        value="{parcel.getBoxHeight()}" />
    </td>
  </tr>

  <tr>
    <td>{t(#Parcel type#)}:</td>
    <td class="inline-options">
      <label for="is-document-{parcelIdx}" IF="!displayOnlyContractedOptions(parcel)">
        <widget
          class="\XLite\View\FormField\Input\Checkbox"
          fieldId="is-document-{parcelIdx}"
          fieldName="parcelsData[{parcel.getId()}][isDocument]"
          fieldOnly="true"
          value="1"
          isChecked="{parcel.getIsDocument()}" />
        {t(#Document#)}
      </label>
      <label for="is-unpackaged-{parcelIdx}">
        <widget
          class="\XLite\View\FormField\Input\Checkbox"
          fieldId="is-unpackaged-{parcelIdx}"
          fieldName="parcelsData[{parcel.getId()}][isUnpackaged]"
          fieldOnly="true"
          value="1"
          isChecked="{parcel.getIsUnpackaged()}" />
        {t(#Unpackaged#)}
      </label>
      <label for="is-mailing-tube-{parcelIdx}">
        <widget
          class="\XLite\View\FormField\Input\Checkbox"
          fieldId="is-mailing-tube-{parcelIdx}"
          fieldName="parcelsData[{parcel.getId()}][isMailingTube]"
          fieldOnly="true"
          value="1"
          isChecked="{parcel.getIsMailingTube()}" />
        {t(#Mailing tube#)}
      </label>
      <label for="is-oversized-{parcelIdx}" IF="displayOnlyContractedOptions(parcel)">
        <widget
          class="\XLite\View\FormField\Input\Checkbox"
          fieldId="is-oversized-{parcelIdx}"
          fieldName="parcelsData[{parcel.getId()}][isOversized]"
          fieldOnly="true"
          value="1"
          isChecked="{parcel.getIsOversized()}" />
        {t(#Oversized#)}
      </label>
    </td>
  </tr>

  <tr>
    <td>{t(#Notification#)}:</td>
    <td class="inline-options">
      <label for="notify-on-shipment-{parcelIdx}">
        <widget
          class="\XLite\View\FormField\Input\Checkbox"
          fieldId="notify-on-shipment-{parcelIdx}"
          fieldName="parcelsData[{parcel.getId()}][notifyOnShipment]"
          fieldOnly="true"
          value="1"
          isChecked="{isNotifyOnShipment(parcel)}" />
        {t(#On shipment#)}
      </label>
      <label for="notify-on-exception-{parcelIdx}">
        <widget
          class="\XLite\View\FormField\Input\Checkbox"
          fieldId="notify-on-exception-{parcelIdx}"
          fieldName="parcelsData[{parcel.getId()}][notifyOnException]"
          fieldOnly="true"
          value="1"
          isChecked="{parcel.getNotifyOnException()}" />
        {t(#On exception#)}
      </label>
      <label for="notify-on-delivery-{parcelIdx}">
        <widget
          class="\XLite\View\FormField\Input\Checkbox"
          fieldId="notify-on-delivery-{parcelIdx}"
          fieldName="parcelsData[{parcel.getId()}][notifyOnDelivery]"
          fieldOnly="true"
          value="1"
          isChecked="{parcel.getNotifyOnDelivery()}" />
        {t(#On delivery#)}
      </label>
    </td>
  </tr>

</table>
