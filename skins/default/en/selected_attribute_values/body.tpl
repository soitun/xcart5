{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Selected attribute values
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="item-attribute-values">
  <ul class="selected-attribute-values">
    {foreach:item.getSortedAttributeValues(),option}
      <li>
        <span>{option.getActualName()}:</span>
        {option.getActualValue()}{if:!optionArrayPointer=optionArraySize}, {end:}
      </li>
    {end:}
  </ul>
  
  <div IF="getParam(#source#)" class="item-change-attribute-values">
    <a href="{getChangeAttributeValuesLink()}">{t(#Change attributes#)}</a>
  </div>
</div>
