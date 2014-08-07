{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Country selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
{if:isLabelBasedSelector()}

  <span class="one-country">{oneCountry.country}</span>
  <input type="hidden" name="{field}" value="{oneCountry.code:r}" />

{else:}

  <select name="{field}"{if:onchange} onchange="{onchange}"{end:}{if:fieldId} id="{fieldId}"{end:} class="{getParam(#className#)} field-country">
    <option IF="!getSelectedValue()" value="">{t(#Select one#)}</option>
    {foreach:getCountries(),v}
      <option value="{v.code:r}" selected="{isSelectedCountry(v.code)}">{v.country}</option>
    {end:}
  </select>

{end:}
