{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Multiple options 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="modifiers" IF="{isModified(attributeValue)}">
  <a href="#" tabindex="-1">{t(#Modifiers#)}</a>
  <span class="text">{getModifiersAsString(attributeValue):h}</span>
  <div class="popup">
    <h4>{t(#Modifiers#)}</h4>
    {foreach:getModifiers(),field,modifier}
      <widget class="\XLite\View\FormField\Input\Text\Modifier" fieldName="{getName(field,id)}" label="{t(modifier.title)}" value="{getModifierValue(attributeValue,field)}" attributes="{_ARRAY_(#data-type#^field)}" />
    {end:}
    <div class="default clearfix"><label><input type="checkbox" name="{getName(#default#,id)}"{if:isDefault(attributeValue)} checked{end:} data-title="{t(#Default#)}" /> {t(#Default option#)}</label></div>
    <div class="arrow"></div>
  </div>
</div>
