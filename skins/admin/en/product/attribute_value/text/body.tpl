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
  <widget class="\XLite\View\FormField\Textarea\Simple" fieldName="{getName()}" maxHeight=100 rows=3 fieldOnly=true value="{attrValue.value}" />
  <widget template="product/attribute_value/text/editable.tpl" />
</div>
