{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attributes
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="XLite\Module\XC\ProductVariants\View\Form\Product\Modify\Attributes" name="update_variants_attributes_form" className="form-attributes" />
  <div class="{getBlockStyle()}">
    <div class="header">
      <span class="title">{t(#Choose the optional attributes that your variants will be based on#)}</span>
      <widget
        class="\XLite\View\Tooltip"
        text="{t(#To set product variants you should select attributes with multiple options.#)}"
        isImageTag="true"
        className="help-icon" />
    </div>
    <div class="content">
      <ul class="data">
        <li FOREACH="getMultipleAttributes(),a" class="fade-variant clearfix">
          <div class="checkbox"><input type="checkbox" name="attr[{a.id}]" value="{a.id}" data-count="{getAttributeCount(a)}"{if:isChecked(a)} checked{end:} /></div>
          <div class="name">
            <span>{a.name}</span>
            <img src="images/spacer.gif" class="right-fade" alt="" />
          </div>
          <div class="values">
            <span FOREACH="a.getAttributeValue(product,1),v">{v}</span>
          </div>
          <div class="title">{getAttributeTitle(a)}:</div>
          <img src="images/spacer.gif" class="right-fade" alt="" />
        </li>
      </ul>
      <div class="buttons" data-attributes-title="{t(#Add variants manually#)}" data-no-attributes-title="{t(#Save changes#)}">
        <widget class="\XLite\View\Button\Submit" style="main-button save-changes" label="{t(#Save changes#)}" />
        <div class="additional">
          <span class="or">{t(#or#)}</span>
          <widget template="modules/XC/ProductVariants/variants/parts/create_variants.tpl" />
        </div>
      </div>
    </div>
  </div>
<widget name="update_variants_attributes_form" end />
