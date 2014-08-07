{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order history event date
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.history.base.events.details.info", weight="20")
 *}
<div id="event-{event.eventId}" class="order-event-details" IF="{getComment(event)}">
  <div class="details">{getComment(event):h}</div>
</div>
