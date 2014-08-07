{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attributes
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="{getBlockStyle()}">
  <div class="header clearfix">
    <span class="title">{getTitle()}</span>
    <widget
      IF="getTooltip()"
      class="\XLite\View\Tooltip"
      text="{getTooltip()}"
      isImageTag="true"
      className="help-icon" />
    <widget class="\XLite\View\Button\Dropdown\AddAttribute" listId="{getListId()}" />
  </div>
  <ul class="data" id="list{getListId()}">
    <li FOREACH="getAttributesList(),id,a" class="line clearfix attribute">
      <div class="attribute-name">
        {a.name.display()}
      </div>
      {a.value.display()}
      <div class="actions">
        <widget class="XLite\View\Button\Remove" buttonName="delete[{id}]" label="{t(#Removing this attribute will affect all the products. Leave this blank to hide this option for the product.#)}" style="delete" />
      </div>
    </li>
    <li IF="!getAttributesList()" class="list-empty">
      {t(#No attributes assigned#)}
    </li>
  </ul>
</div>
{foreach:getAttributeGroups(),group}
  <widget class="XLite\View\Product\Details\Admin\Attributes" group="{group}" />
{end:}
