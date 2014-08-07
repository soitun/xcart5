{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shipments page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="capost-shipments">
  
  <widget class="XLite\Module\XC\CanadaPost\View\Form\Parcel" name="update_parcels_form" />

    <div FOREACH="getCapostOrderParcels(),parcelIdx,parcel" class="ca-package">
      
      {displayCommentedData(getParcelJSParams(parcel))}

      <a name="package_{parcel.getNumber()}"></a>
  
      <h2>{t(#Parcel#)} #{parcel.getNumber()}</h2>

      <div class="parcel-products">
        <widget class="\XLite\Module\XC\CanadaPost\View\ItemsList\Model\ParcelItem" name="parcel-items-{parcel.getId()}" parcelId="{parcel.getId()}" />
      </div>

      <div class="parcel-settings">

        <div class="box parcel-characteristics">
          <widget template="modules/XC/CanadaPost/shipments/parcel.characteristics.tpl" />
        </div>

        <div class="box border">
          <widget template="modules/XC/CanadaPost/shipments/parcel.options.tpl" />
        </div>

        <div style="clear: both;"></div>

      </div>
      
      <widget IF="parcel.hasShipment()" template="modules/XC/CanadaPost/shipments/shipment.info.tpl" />
          
      <div IF="parcel.areAPICallsAllowed()" class="buttons">

        <widget 
          IF="displayCreateShipmentButton(parcel)"
          class="\XLite\Module\XC\CanadaPost\View\Button\CreateShipment"
          parcelId="{parcel.getId()}" />

        <widget 
          IF="displayVoidShipmentButton(parcel)"
          class="\XLite\Module\XC\CanadaPost\View\Button\VoidShipment"
          parcelId="{parcel.getId()}" />

        <widget 
          IF="displayTransmitShipmentButton(parcel)"
          class="\XLite\Module\XC\CanadaPost\View\Button\TransmitShipment"
          parcelId="{parcel.getId()}" />

      </div>
      
      <div IF="getParcelWarnings(parcel)" class="parcel-warnings">

        <br />

        <h4>{t(#Warnings#)}:</h2>

        <ul>
          <li FOREACH="getParcelWarnings(parcel),warning">{warning.message}</li>
        </ul>

      </div>

    </div>

    <widget class="XLite\Module\XC\CanadaPost\View\StickyPanel\Order\Admin\Shipments" />

  <widget name="update_parcels_form" end />

</div>
