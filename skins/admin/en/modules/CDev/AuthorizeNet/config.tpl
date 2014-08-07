{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Authorize.Net SIM configuration page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<table cellspacing="1" cellpadding="5" class="settings-table">

  <tr>
    <td class="setting-name">
    <label for="settings_login">{t(#API Login ID#)}</label>
    </td>
    <td>
    <input type="text" id="settings_login" name="settings[login]" value="{paymentMethod.getSetting(#login#)}" class="validate[required,maxSize[255]]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
    <label for="settings_key">{t(#Transaction key#)}</label>
    </td>
    <td>
    <input type="text" id="settings_key" name="settings[key]" value="{paymentMethod.getSetting(#key#)}" class="validate[required,maxSize[255]]" />
    </td>
  </tr>

  <tr>
    <td colspan="2" class="note">
To obtain the transaction key from the Merchant Interface, do the following:
<ol>
  <li>Log into the Merchant Interface</li>
  <li>Select Settings from the Main Menu</li>
  <li>Click on Obtain Transaction Key in the Security section</li>
  <li>Type in the answer to the secret question configured on setup</li>
  <li>Click Submit</li>
</ol>
    </td>
  </tr>

  <tr>
    <td class="setting-name">
    <label for="settings_type">{t(#Transaction type#)}</label>
    </td>
    <td>
    <select id="settings_type" name="settings[type]">
      <option value="sale" selected="{isSelected(paymentMethod.getSetting(#type#),#sale#)}">Auth and Capture</option>
      <option value="auth" selected="{isSelected(paymentMethod.getSetting(#type#),#auth#)}">Auth only</option>
    </select>
    </td>
  </tr>

  <tr>
    <td class="setting-name">
    <label for="settings_test">{t(#Processing mode#)}</label>
    </td>
    <td>
    <select id="settings_test" name="settings[test]">
      <option value="1" selected="{isSelected(paymentMethod.getSetting(#test#),#1#)}">Test mode</option>
      <option value="0" selected="{isSelected(paymentMethod.getSetting(#test#),#0#)}">Real transaction</option>
    </select>
    </td>
  </tr>

  <tr>
    <td class="setting-name">
    <label for="settings_prefix">{t(#Invoice number prefix#)}</label>
    </td>
    <td>
    <input type="text" id="settings_prefix" value="{paymentMethod.getSetting(#prefix#)}" name="settings[prefix]" />
    </td>
  </tr>

</table>
