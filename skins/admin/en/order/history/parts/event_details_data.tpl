{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order history event date
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.history.base.events.details.info", weight="30")
 *}
<div id="event-{event.eventId}" class="order-event-details" IF="getDetails(event)">
  <div class="details">
    <ul>
      <li FOREACH="getDetails(event),columnId,columnData" class="order-history-object-detail-column">
        <ul>
          <li FOREACH="columnData,cell_id,cell">
            <span class="event-details-label">{cell.getName()}:</span> <span class="value">{cell.getValue()}</span>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>
