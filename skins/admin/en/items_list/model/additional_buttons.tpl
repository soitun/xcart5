{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Additional buttons list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="additional-buttons">
<span class="or" IF="isDisplayORLabel()">{t(#or#)}</span>
<div class="btn-group dropup">
<button type="button" class="btn regular-button toggle-list-action dropdown-toggle{if:hasMoreActionsButtons()} more-actions{end:}" data-toggle="dropdown">
  {getMoreActionsText():h}
  <span class="caret"></span>
  <span class="sr-only"></span>
</button>
<ul class="dropdown-menu" role="menu">
  {foreach:getAdditionalButtons(),i,button}
  <li IF="!button.isDivider()" class="{getSubcellClass(buttonArrayPointer,i,button)}">{button.display():h}</li>
  <li IF="button.isDivider()" class="divider"></li>
  {end:}
</ul>
</div>
</div>
