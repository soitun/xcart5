{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Dropdown button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="btn-dropdown btn-group">
  <button {if:hasName()} name="{getName()}"{end:}{if:hasValue()} value="{getValue()}"{end:} type="button" class="main btn btn-default{if:getStyle()} {getStyle()}{end:}">
    <span>{t(getButtonLabel())}</span>
  </button>

  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
    <span class="sr-only"></span>
  </button>

{if:getAdditionalButtons()}
<ul class="dropdown-menu" role="menu">
  <li FOREACH="getAdditionalButtons(),button">{button.display():h}</li>
</ul>
{end:}
</div>
