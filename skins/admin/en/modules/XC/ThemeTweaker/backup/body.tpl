{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Backup template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div id="code_backup_link">
  {t(#The database stores different version of the custom changes.#)}
  <a href="#">{t(#Review it.#)}</a>
</div>
<div id="code_backup">
  <widget class="\XLite\Module\XC\ThemeTweaker\View\Form\Backup" name="backup_form" />
  
    <widget class="\XLite\Module\XC\ThemeTweaker\View\FormField\Textarea\CodeMirror" fieldName="backup" cols="140" rows="20" fieldId="backup" codeMode="{getCodeMode()}" value="{getBackupContent()}" readOnly="true" fieldOnly="true" />
  
    <div class="buttons">
      <widget class="\XLite\View\Button\Submit" style="action" label="{t(#Restore this version#)}" />
      <a class="hide" href="#">{t(#Hide#)}</a>
    </div>
  
  <widget name="backup_form" end />
</div>
