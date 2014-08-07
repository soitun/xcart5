{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * AustraliaPost settings dialog template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="admin-title">Australia Post settings</div>

<br />

<form action="{buildURL()}" method="post">

  <input type="hidden" name="target" value="aupost" />
  <input type="hidden" name="action" value="update" />
  <widget class="\XLite\View\FormField\Input\FormId" />

  <table cellpadding="2" cellspacing="3">

    <tr>
      <td colspan="2"><h3>Account settings</h3></td>
    </tr>

    <tr>
      <td width="250"><b>Use test server:</b></td>
      <td><input type="checkbox" name="test_mode" id="aus-test-mode" value="Y" {if:config.CDev.AustraliaPost.test_mode=#Y#}checked="checked"{end:} /></td>
    </tr>

    <tbody id="aus-api-key" {if:config.CDev.AustraliaPost.test_mode=#Y#} style="display: none;"{end:}>

      <tr>
        <td><b>API key:</b></td>
        <td><input type="text" name="api_key" value="{config.CDev.AustraliaPost.api_key:r}" size="30" /></td>
      </tr>

      <tr>
        <td colspan="2"><a href="http://auspost.com.au/devcentre/pacpcs.html" target="_new">Register</a> to receive a unique 32 character API key to use the Postage Assessment Calculator API in live mode.</td>
      </tr>

    </tbody>

    <tr>
      <td colspan="2"><h3>Package settings</h3></td>
    </tr>

    <tr>
      <td><b>Package box type:</b></td>
      <td>
        <select name="package_box_type" id="aus-package-box-type">
        {foreach:getPackageBoxTypeOptions(),opkey,opval}
          <option value="{opval.code}" selected="{isSelected(config.CDev.AustraliaPost.package_box_type,opval.code)}">{opval.name}</option>
        {end:}
        </select>
      </td>
    </tr>

    <tbody id="aus-own-package-size"{if:!config.CDev.AustraliaPost.package_box_type=#AUS_PARCEL_TYPE_BOXED_OTH#} style="display: none;"{end:}>

      <tr>
        <td><b>{t(#Package dimensions (cm)#)}:</b></td>
        <td nowrap="nowrap">
          <table cellspacing="1" cellpadding="0" border="0">
            <tbody><tr>
                <td>{t(#Length#)}</td>
                <td></td>
                <td>{t(#Width#)}</td>
                <td></td>
                <td>{t(#Height#)}</td>
              </tr>
              <tr>
                <td><input type="text" size="6" value="{config.CDev.AustraliaPost.length:r}" name="length" /></td>
                <td>&nbsp;x&nbsp;</td>
                <td><input type="text" size="6" value="{config.CDev.AustraliaPost.width:r}" name="width" /></td>
                <td>&nbsp;x&nbsp;</td>
                <td><input type="text" size="6" value="{config.CDev.AustraliaPost.height:r}" name="height" /></td>
              </tr>
          </tbody></table>
        </td>
      </tr>

    </tbody>

    <tr>
      <td colspan="2"><h3>Additional options</h3></td>
    </tr>

    <tr>
      <td><b>Service options:</b></td>
      <td>
        <select name="service_option">
        {foreach:getAuspostServiceOptions(),opkey,opval}
          <option value="{opkey}" selected="{isSelected(config.CDev.AustraliaPost.service_option,opkey)}">{opval}</option>
        {end:}
        </select>
      </td>
    </tr>

    <tr>
      <td><b>Extra cover:</b></td>
      <td><input type="checkbox" name="extra_cover" id="aus-extra-cover" value="Y"{if:config.CDev.AustraliaPost.extra_cover=#Y#} checked="checked"{end:} /></td>
    </tr>

    <tbody id="aus-extra-cover-value"{if:!config.CDev.AustraliaPost.extra_cover=#Y#} style="display: none;"{end:}>

    <tr>
      <td><b>Extra cover value (up to 5000 AUD):</b></td>
      <td><input type="text" name="extra_cover_value" value="{config.CDev.AustraliaPost.extra_cover_value:r}" size="15" /></td>
    </tr>

    <tr>
      <td colspan="2">The specified value (if not empty) will be used as an extra cover value. Otherwise an order total will be used</td>
    </tr>

    </tbody>

    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
      <td><b>Currency rate:</b></td>
      <td><input type="text" name="currency_rate" value="{config.CDev.AustraliaPost.currency_rate:r}" size="8" /></td>
    </tr>

    <tr>
      <td colspan="2">(specify rate X, where 1 AUD = X in shop currency)</td>
    </tr>

    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
      <td><b>Enable new methods:</b></td>
      <td><input type="checkbox" name="enable_new_methods" value="Y"{if:config.CDev.AustraliaPost.enable_new_methods=#Y#} checked="checked"{end:} /></td>
    </tr>

    <tr>
      <td colspan="2">{t(#When AustraliaPost returns shipping methods which does not exists in the available methods list, these methods will be created in the list automatically#,_ARRAY_(#URL#^buildURL(#shipping_methods#))):h}</td>
    </tr>

    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
      <td><b>Enable debugging:</b></td>
      <td><input type="checkbox" name="debug_enabled" value="Y"{if:config.CDev.AustraliaPost.debug_enabled=#Y#} checked="checked"{end:} /></td>
    </tr>

    <tr>
      <td colspan="2">{t(#This option enables logging of all communication between shopping cart and AustraliaPost server#)}</td>
    </tr>

    <tr>
      <td colspan="2"><br /><widget class="\XLite\View\Button\Submit" label="Save" style="regular-main-button action" /></td>
    </tr>

  </table>

</form>

<widget class="\XLite\View\Button\Regular" jsCode="self.location='{buildURL(#aupost#,#renew_settings#)}'" label="Renew available settings" style="link" />
