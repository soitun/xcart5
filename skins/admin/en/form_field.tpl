{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:!getParam(#fieldOnly#)}
  <div class="{getLabelContainerClass()}">
    <label IF="getParam(#useColon#)" for="{getFieldId()}" title="{getFormattedLabel():h}">{getFormattedLabel()}:</label>
    <label IF="!getParam(#useColon#)" for="{getFieldId()}" title="{getFormattedLabel():h}">{getFormattedLabel()}</label>
  </div>
  <div IF="getParam(#required#)" class="star">*</div>
  <div IF="!getParam(#required#)" class="star">&nbsp;</div>
{end:}

<div class="{getValueContainerClass()}">
  <widget template="{getDir()}/{getFieldTemplate()}" />
  <widget IF="getParam(#help#)" class="\XLite\View\Tooltip" text="{t(getParam(#help#))}" isImageTag=true className="help-icon" />
  <div IF="getParam(#comment#)" class="form-field-comment {getFieldId()}-comment">{t(getParam(#comment#)):h}</div>
  {if:getFormFieldJSData()}{displayCommentedData(getFormFieldJSData())}{end:}
  <script IF="getInlineJSCode()" type="text/javascript">{getInlineJSCode():h}</script>
</div>

{if:!getParam(#fieldOnly#)}
  <div class="clear"></div>
{end:}
