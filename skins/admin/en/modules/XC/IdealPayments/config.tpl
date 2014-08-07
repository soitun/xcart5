{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * iDEAL Professional configuration page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div IF="!paymentMethod.processor.isOpenSSLExists()" class="top-note warning">
  {t(#Warning! This payment method requires OpenSSL extension. Please install and enable this extension in your PHP configuration.#)}
</div>

{if:paymentMethod.processor.isAllSettingsProvided(paymentMethod)}

<div IF="!paymentMethod.processor.checkProcessorSettings()" class="top-note warning">
  {t(#Warning! Please re-check public and private key values!#)}
</div>

{end:}

<table cellspacing="1" cellpadding="5" class="settings-table">

  <tr>
    <td class="setting-name">
      <label for="settings_merchant_id">{t(#iDEAL Merchant ID#)}</label>
    </td>
    <td>
      <input type="text" id="settings_merchant_id" name="settings[merchant_id]" value="{paymentMethod.getSetting(#merchant_id#)}" class="validate[required,maxSize[255]]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_subid">{t(#iDEAL SubID#)}</label>
    </td>
    <td>
      <input type="text" id="settings_subid" name="settings[subid]" value="{paymentMethod.getSetting(#subid#)}" class="validate[required,maxSize[255]]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_pub_cert">{t(#iDEAL Public Certificate File#)}</label>
    </td>
    <td>
      <input type="text" id="settings_pub_cert" name="settings[pub_cert]" value="{paymentMethod.getSetting(#pub_cert#)}" class="validate[required,maxSize[255]]" style="width: 90%;"/>
      <widget class="\XLite\View\Tooltip" id="pub-cert-help" text="{t(#File with certificate should be located in the directory classes/XLite/Module/XC/IdealPayments/cert#):h}" isImageTag="true" className="help-icon" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_pub_key">{t(#iDEAL Public Key#)}</label>
    </td>
    <td>
      <textarea id="settings_pub_key" name="settings[pub_key]" rows="10" cols="70" style="font-family: Courier; font-size: 12px;">{paymentMethod.getSetting(#pub_key#)}</textarea>
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_private_key">{t(#iDEAL Private Key#)}</label>
    </td>
    <td>
      <textarea id="settings_private_key" name="settings[private_key]" rows="10" cols="70" style="font-family: Courier; font-size: 12px; margin-top: 5px;">{paymentMethod.getSetting(#private_key#)}</textarea>
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_private_key_pass">{t(#iDEAL Private Key Password#)}</label>
    </td>
    <td>
      <input type="password" id="settings_private_key_pass" name="settings[private_key_pass]" value="{paymentMethod.getSetting(#private_key_pass#)}" class="validate[required,maxSize[255]]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_currency">{t(#iDEAL Currency#)}</label>
    </td>
    <td>
    <select id="settings_currency" name="settings[currency]">
      <option value="EUR" selected="{isSelected(paymentMethod.getSetting(#currency#),#EUR#)}">EUR</option>
    </select>
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_prefix">{t(#iDEAL Invoice number prefix#)}</label>
    </td>
    <td>
      <input type="text" id="settings_prefix" value="{paymentMethod.getSetting(#prefix#)}" name="settings[prefix]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
    <label for="settings_test">{t(#iDEAL Test/Live mode#)}</label>
    </td>
    <td>
    <select id="settings_test" name="settings[test]">
      <option value="Y" selected="{isSelected(paymentMethod.getSetting(#test#),#Y#)}">{t(#Test mode#)}</option>
      <option value="N" selected="{isSelected(paymentMethod.getSetting(#test#),#N#)}">{t(#Live mode#)}</option>
    </select>
    </td>
  </tr>

  <tr>
    <td class="setting-name">
      <label for="settings_debug_enabled">{t(#iDEAL Enable logging of iDEAL transactions#)}</label>
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
