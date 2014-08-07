{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Listbox template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="listbox">

  <input type="hidden" id="{getFieldId()}-store" name="{getName()}" value="" />

  <div class="listbox-item from">
    <widget class="\XLite\View\FormField\Select\Multiple" fieldId="{getFieldId()}-listbox-select-from" label="{getLabelFrom()}" options="{getOptionsFrom()}" />
  </div>

  <div class="listbox-actions">
    <widget class="\XLite\View\Button\Regular" label="&gt;&gt;" id="to-{getFieldId()}"  jsCode="moveSelect('{getFieldId()}', true);" />
    <widget class="\XLite\View\Button\Regular" label="&lt;&lt;" id="from-{getFieldId()}"  jsCode="moveSelect('{getFieldId()}', false);" />
  </div>

  <div class="listbox-item from">
    <widget class="\XLite\View\FormField\Select\Multiple" fieldId="{getFieldId()}-listbox-select-to" label="{getLabelTo()}" options="{getOptionsTo()}" />
  </div>

</div>
