{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Code template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="\XLite\Module\XC\ThemeTweaker\View\Form\Code" name="form" />

  <input type="checkbox" value="1"{if:isUsed()} checked="checked"{end:} id="use_custom" name="use" /> <label for="use_custom">{getUseCustomText()}</label>
  <br /><br />

  <widget class="\XLite\Module\XC\ThemeTweaker\View\FormField\Textarea\CodeMirror" fieldName="code" cols="140" rows="20" fieldId="code" codeMode="{getCodeMode()}" value="{getFileContent()}" fieldOnly="true" />

  <div class="buttons">
    <widget class="\XLite\View\Button\Submit" style="action" label="Save" />
  </div>

<widget name="form" end />
