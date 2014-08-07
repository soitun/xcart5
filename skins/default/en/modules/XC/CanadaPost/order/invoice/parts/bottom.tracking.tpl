{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Tracking pins
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.bottom", weight="25")
 *}

{if:getCapostTrackingPins()}

  <td>
    {t(#Tracking pins#)}:<br />
    {foreach:getCapostTrackingPins(),pin}
      <a href="{buildURL(#capost_tracking#,##,_ARRAY_(#shipment_id#^pin.shipment_id,#widget#^#XLite\Module\XC\CanadaPost\View\TrackingDetails#))}" class="capost-tracking-link">{pin.pin_number}</a><br />
    {end:}
  </td>

  <td>&nbsp;</td>

{end:}
