{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Common selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="fade-up"> </div>
<ul id="{getFieldId()}">
  {foreach:getOptions(),optionValue,optionLabel}
    <li{if:isOptionSelected(optionValue)} class="checked"{end:}>
      <input id="{getName()}_{optionValue}" type="checkbox" value="{optionValue}" checked="{isOptionSelected(optionValue)}" name="{getName()}[{optionValue}]" />
      <label for="{getName()}_{optionValue}">{optionLabel}</label>
    </li>
  {end:}
</ul>
<div class="fade-down"> </div>
