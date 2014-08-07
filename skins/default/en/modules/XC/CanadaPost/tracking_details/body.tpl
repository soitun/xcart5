{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Tracking details page template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<span IF="!getTrackingDetails()">{t(#No events found#)}</span>

{if:getTrackingDetails()}

  <table cellpadding="2" cellspacing="3">

    <tr FOREACH="trackingDetails.getSignificantEvents(),event">
      <td class="date">{event.getDate()} {event.getTime()}</td>
      <td class="description">{event.getDescription()}</td>
    </tr>

  </table>

  <br />
  
  <div IF="trackingDetails.hasFiles()">
    
    <span>{t(#Attached files#)}:</span><br />
    
    <ul>
      <li FOREACH="trackingDetails.getFiles(),file"><a href="{file.getGetterURL()}">{file.getTitle()}</a></li>
    </ul>
    
  </div>

{end:}
