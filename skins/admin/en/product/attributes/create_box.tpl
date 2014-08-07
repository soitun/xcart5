{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Create box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<li class="create-tpl clearfix" style="display:none">
  <div class="attribute-name">
   <widget class="XLite\View\FormField\Input\Text" fieldName="newValue[NEW_ID][name]" fieldOnly=true required=true attributes="{_ARRAY_(#placeholder#^t(#Attribute name#))}" />
    <input type="hidden" name="newValue[NEW_ID][listId]" value="NEW_LIST_ID" /> 
    <input type="hidden" name="newValue[NEW_ID][type]" value="NEW_TYPE" /> 
  </div>
  {foreach:getDefaultWidgets(),w}
    {w.display()}
  {end:}
  <div class="actions">
    <widget class="XLite\View\Button\Remove" label="{t(#Removing this attribute will affect all the products. Leave this blank to hide this option for the product.#)}" style="delete" />
  </div>
</li>
