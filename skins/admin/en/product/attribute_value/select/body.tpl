{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attribute value (Select)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="{getStyle()}">
  <widget template="product/attribute_value/multiple_options.tpl" />
  <ul class="values">
    <li FOREACH="getAttrValues(),id,attributeValue" class="{getValueStyle(id)}">
      <div class="value">
        <widget class="{getWidgetClass()}" fieldName="{getName(#value#,id)}" fieldOnly=true value="{getFieldValue(attributeValue)}" attribute="{getAttribute()}" attributes="{_ARRAY_(#placeholder#^t(#Attribute option#))}" />
        <widget template="product/attribute_value/modifiers.tpl" />
      </div>
      <div class="actions">
        <widget class="XLite\View\Button\Remove" buttonName="{getName(#deleteValue#,id)}" />
      </div>
    </li>
  </ul>
</div>
