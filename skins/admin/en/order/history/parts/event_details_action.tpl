{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order history event date
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.history.base.events.details", weight="20")
 *}
<li class="details" IF="{isDisplayDetails(event)}">
  <div class="action">
    <i data-interval="0" data-toggle="collapse" id="event-{event.eventId}-action" data-target="#event-{event.eventId}" class="fa fa-plus-square-o"></i>
  </div>
</li>
