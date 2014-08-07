{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Event task progress bar
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="progress-bar {if:isBlockingDriver()}blocking{else:}noblocking{end:}" data-event="{getEvent()}">

  <h3 IF="getEventTitle()">{getEventTitle()}</h3>
  <div class="bar" data-percent="{getPercent()}" title="{getPercent()}%"></div>
  {if:isBlockingDriver()}
    <p IF="getBlockingNote()" class="note">{getBlockingNote()}</p>
  {else:}
    <p if="getNonBlockingNote()" class="note">{getNonBlockingNote()}</p>
  {end:}

</div>
