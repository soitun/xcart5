{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ePDQ configuration page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="settings-text">
  {t(#ePDQ settings note#,_ARRAY_(#URL#^getShopURL())):h}
</div>

<table cellspacing="1" cellpadding="5" class="settings-table">

  <tr>
    <td class="setting-name">
      <label for="settings_pspid">{t(#ePDQ PSPID#)}</label>
    </td>
    <td>
      <input type="text" id="settings_pspid" name="settings[pspid]" value="{paymentMethod.getSetting(#pspid#)}" class="validate[required,maxSize[255]]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_sha_in">{t(#ePDQ SHA-IN pass phrase#)}</label>
    </td>
    <td>
      <input type="password" id="settings_sha_in" name="settings[sha_in]" value="{paymentMethod.getSetting(#sha_in#)}" class="validate[required,maxSize[255]]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_sha_out">{t(#ePDQ SHA-OUT pass phrase#)}</label>
    </td>
    <td>
      <input type="password" id="settings_sha_out" name="settings[sha_out]" value="{paymentMethod.getSetting(#sha_out#)}" class="validate[required,maxSize[255]]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_currency">{t(#ePDQ Currency#)}</label>
    </td>
    <td>
      <widget class="\XLite\View\FormField\Select\Currency" fieldId="settings_currency" fieldName="settings[currency]" fieldValue="{paymentMethod.getSetting(#currency#)}" fieldOnly="true" useCodeAsKey="true" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_prefix">{t(#ePDQ Invoice number prefix#)}</label>
    </td>
    <td>
      <input type="text" id="settings_prefix" value="{paymentMethod.getSetting(#prefix#)}" name="settings[prefix]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
    <label for="settings_test">{t(#ePDQ Test/Live mode#)}</label>
    </td>
    <td>
    <select id="settings_test" name="settings[test]">
      <option value="1" selected="{isSelected(paymentMethod.getSetting(#test#),#1#)}">{t(#Test mode#)}</option>
      <option value="0" selected="{isSelected(paymentMethod.getSetting(#test#),#0#)}">{t(#Live mode#)}</option>
    </select>
    </td>
  </tr>


  <tr>
    <td class="setting-name">
      <label for="settings_debug_enabled">{t(#ePDQ Enable logging of ePDQ transactions#)}</label>
    </td>
    <td>
      <select id="settings_debug_enabled" name='settings[debug_enabled]'>
        <option value="0" selected="{isSelected(paymentMethod.getSetting(#debug_enabled#),#0#)}">{t(#No#)}</option>
        <option value="1" selected="{isSelected(paymentMethod.getSetting(#debug_enabled#),#1#)}">{t(#Yes#)}</option>
      </select>
    </td>
  </tr>

</table>

<script type="text/javascript">
  jQuery("#settings_currency").val("{paymentMethod.getSetting(#currency#)}");
</script>
