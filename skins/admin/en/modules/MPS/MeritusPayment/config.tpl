{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Meritus configuration page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<table cellspacing="1" cellpadding="5" class="settings-table">

  <tr>
    <td colspan="2" class="note">
      {t(#Meritus payment description#):h}
    </td>
  </tr>

  <tr>
    <td class="setting-name">
    <label for="settings_merchantID">{t(#Merchant ID#)}</label>
    </td>
    <td>
    <input type="text" id="settings_merchantID" name="settings[merchantID]" value="{paymentMethod.getSetting(#merchantID#)}" class="validate[required,maxSize[255]]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
    <label for="settings_merchantKey">{t(#Merchant Key#)}</label>
    </td>
    <td>
    <input type="text" id="settings_merchantKey" name="settings[merchantKey]" value="{paymentMethod.getSetting(#merchantKey#)}" class="validate[required,maxSize[255]]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
    <label for="settings_orderPrefix">{t(#Order prefix#)}</label>
    </td>
    <td>
    <input type="text" id="settings_orderPrefix" name="settings[orderPrefix]" value="{paymentMethod.getSetting(#orderPrefix#)}" class="validate[required,maxSize[255]]" />
    </td>
  </tr>

  <tr>
    <td class="setting-name">
    <label for="settings_currency">{t(#Currency#)}</label>
    </td>
    <td>USD</td>
  </tr>

</table>
