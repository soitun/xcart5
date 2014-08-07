{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attribute value (Text)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="{getStyle()}">
  <widget template="product/attribute_value/multiple_options.tpl" />
  <div class="single-option">
    <widget class="\XLite\View\FormField\Select\YesNoEmpty" fieldName="{getName()}" fieldOnly=true value="{getSelectValue()}" />
  </div>
  <ul class="multiple-options">
    <li FOREACH="getAttrValues(),id,attributeValue" class="clearfix line value">
      <div class="value">
        <widget class="\XLite\View\FormField\Input\Text" fieldOnly=true value="{getLabel(id)}" attributes="{_ARRAY_(#readonly#^#readonly#)}" wrapperClass="attribute-value-checkbox" />
        <widget template="product/attribute_value/modifiers.tpl" />
      </div>
    </li>
  </ul>
</div>
