{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shipments info
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="shipment-info">
  
  <div class="shipment-info-part">

    <h3>{t(#Shipment info#)}</h3>

    <table>
      
      <tr>
        <td>{t(#Shipment ID#)}:</td>
        <td>{parcel.shipment.getShipmentId()}</td>
      </tr>
      
      {*
      <tr IF="parcel.shipment.getShipmentStatus()">
        <td>{t(#Shipment status#)}:</td>
        <td>{parcel.shipment.getShipmentStatus()}</td>
      </tr>
      *}

      <tr IF="parcel.shipment.getTrackingPin()">
        <td>{t(#Tracking pin#)}:</td>
        <td><a href="{buildURL(#capost_tracking#,##,_ARRAY_(#shipment_id#^parcel.shipment.getId(),#widget#^#XLite\Module\XC\CanadaPost\View\TrackingDetails#))}" class="tracking-details-link">{parcel.shipment.getTrackingPin()}</a></td>
      </tr>

      <tr IF="parcel.shipment.getReturnTrackingPin()">
        <td>{t(#Return tracking pin#)}:</td>
        <td>{parcel.shipment.getReturnTrackingPin()}</td>
      </tr>

      <tr IF="parcel.shipment.getPoNumber()">
        <td>{t(#PO Number#)}:</td>
        <td>{parcel.shipment.getPoNumber()}</td>
      </tr>

      <tr IF="parcel.shipment.getLinks()">
        <td>{t(#Documents#)}:</td>
        <td>
          <ul>
            <li FOREACH="parcel.shipment.getPDFLinks(),link">
              <a href="{link.getURL()}">{link.getLinkTitle()}</a>
            </li>
          </ul>
        </td>
      </tr>

    </table>

  </div>

  <div IF="parcel.shipment.hasManifests()" class="shipment-info-part">
    
    <h3>{t(#Manifests#)}</h3>

    {foreach:parcel.shipment.getManifests(),manifest}
      
      <table>
      
        <tr>
          <td>{t(#Manifest ID#)}:</td>
          <td>{manifest.getManifestId()}</td>
        </tr>

        <tr>
          <td>{t(#PO number#)}:</td>
          <td>{manifest.getPoNumber()}</td>
        </tr>

        <tr IF="manifest.getLinks()">
          <td>{t(#Documents#)}:</td>
          <td>
            <ul>
              {foreach:manifest.getLinks(),link}
                <li IF="link.getStorage()">
                  <a href="{link.storage.getGetterURL()}">{link.getLinkTitle()}</a>
                </li>
              {end:}
            </ul>
          </td>
        </tr>

      </table>

    {end:}

  </div>

  <div style="clear: both;"></div>

</div>
