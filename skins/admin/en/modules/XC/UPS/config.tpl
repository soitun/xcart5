{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * UPS settings dialog template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="admin-title">{t(#UPS settings#)}</div>

<br />

<form action="{buildURL()}" method="post">

  <input type="hidden" name="target" value="ups" />
  <input type="hidden" name="action" value="update" />
  <widget class="\XLite\View\FormField\Input\FormId" />

  <table cellpadding="2" cellspacing="3">

    <tr>
      <td colspan="2"><h3>{t(#Account settings#)}</h3></td>
    </tr>

    <tr>
      <td colspan="2">{t(#To use UPS Rating API you need to register on <a href="http://www.ups.com/" target="_new">UPS.com</a> with a User ID and Password. Once you have registered you would need to obtain an Access Key from UPS.com that provides access to the Rating API. To obtain an Access Key an account number needs to be added or created in your UPS.com profile.#):h}</td>
    </tr>

    <tr>
      <td width="250"><b>{t(#User ID#)}:</b></td>
      <td><input type="text" name="userID" value="{config.XC.UPS.userID:r}" size="30" /></td>
    </tr>

    <tr>
      <td><b>{t(#Password#)}:</b></td>
      <td><input type="text" name="password" value="{config.XC.UPS.password:r}" size="30" /></td>
    </tr>

    <tr>
      <td><b>{t(#Access key#)}:</b></td>
      <td><input type="text" name="accessKey" value="{config.XC.UPS.accessKey:r}" size="30" /></td>
    </tr>

    <tr>
      <td><b>{t(#UPS account number#)}:</b></td>
      <td><input type="text" name="shipper_number" value="{config.XC.UPS.shipper_number:r}" size="30" /></td>
    </tr>

    <tr>
      <td colspan="2">{t(#A shipper's UPS account number is required when requesting to receive the negotiated rates.#)}</td>
    </tr>

    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
      <td><b>{t(#Test mode#)}:</b></td>
      <td><input type="checkbox" name="test_mode" value="Y" {if:config.XC.UPS.test_mode=#Y#}checked="checked"{end:} /></td>
    </tr>

    <tr>
      <td colspan="2"><h3>{t(#Package settings#)}</h3></td>
    </tr>

    <tr>
      <td><b>{t(#Package box type#)}:</b></td>
      <td>
        <select name="packaging_type" id="ups-packaging-type">
        {foreach:getPackageTypeOptions(),opkey,opval}
          <option value="{opkey}" selected="{isSelected(config.XC.UPS.packaging_type,opkey)}">{t(opval.name)}</option>
        {end:}
        </select>
      </td>
    </tr>

    <tbody id="ups-own-package-size">

      <tr>
        <td><b>{t(#Package dimensions#)} ({getDimUnit()}):</b></td>
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
                <td><input type="text" size="6" value="{config.XC.UPS.length:r}" name="length" /></td>
                <td>&nbsp;x&nbsp;</td>
                <td><input type="text" size="6" value="{config.XC.UPS.width:r}" name="width" /></td>
                <td>&nbsp;x&nbsp;</td>
                <td><input type="text" size="6" value="{config.XC.UPS.height:r}" name="height" /></td>
              </tr>
          </tbody></table>
        </td>
      </tr>

    </tbody>

    <tr>
      <td><b>{t(#Maximum package weight#)} ({getWeightSymbol()}):</b></td>
      <td><input type="text" name="max_weight" value="{config.XC.UPS.max_weight:r}" size="10" /></td>
    </tr>


    <tr>
      <td colspan="2"><h3>{t(#Service options#)}</h3></td>
    </tr>

    <tr>
      <td><b>{t(#Pickup type#)}:</b></td>
      <td>
        <select name="pickup_type">
        {foreach:getPickupTypeOptions(),opkey,opval}
          <option value="{opkey}" selected="{isSelected(config.XC.UPS.pickup_type,opkey)}">{t(opval)}</option>
        {end:}
        </select>
      </td>
    </tr>

    <tr>
      <td><b>{t(#Saturday pickup#)}:</b></td>
      <td><input type="checkbox" name="saturday_pickup" value="SP"{if:config.XC.UPS.saturday_pickup=#Y#} checked="checked"{end:} /></td>
    </tr>

    <tr>
      <td><b>{t(#Additional handling#)}:</b></td>
      <td><input type="checkbox" name="additional_handling" value="AH"{if:config.XC.UPS.additional_handling=#Y#} checked="checked"{end:} /></td>
    </tr>

    <tr>
      <td><b>{t(#Saturday delivery#)}:</b></td>
      <td><input type="checkbox" name="saturday_delivery" value="SD"{if:config.XC.UPS.saturday_delivery=#Y#} checked="checked"{end:} /></td>
    </tr>

    <tr>
      <td><b>{t(#Use negotiated rates#)}:</b></td>
      <td><input type="checkbox" name="negotiated_rates" value="Y"{if:config.XC.UPS.negotiated_rates=#Y#} checked="checked"{end:} /></td>
    </tr>

    <tr>
      <td><b>{t(#Delivery confirmation#)}:</b></td>
      <td>
        <select name="delivery_conf">
        {foreach:getUPSDevileryConfOptions(),opkey,opval}
          <option value="{opkey}" selected="{isSelected(config.XC.UPS.delivery_conf,opkey)}">{t(opval)}</option>
        {end:}
        </select>
      </td>
    </tr>

    <tr>
      <td><b>{t(#Add insured value#)}:</b></td>
      <td><input type="checkbox" name="extra_cover" id="ups-extra-cover" value="Y"{if:config.XC.UPS.extra_cover=#Y#} checked="checked"{end:} /></td>
    </tr>

    <tbody id="ups-extra-cover-value"{if:!config.XC.UPS.extra_cover=#Y#} style="display: none;"{end:}>

    <tr>
      <td><b>{t(#Insured value#)}:</b></td>
      <td><input type="text" name="extra_cover_value" value="{config.XC.UPS.extra_cover_value:r}" size="15" /></td>
    </tr>

    <tr>
      <td colspan="2">{t(#The specified value (if not empty) will be used as an extra cover value. Otherwise an order total will be used#)}</td>
    </tr>

    </tbody>

    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
      <td colspan="2"><h3>{t(#Cash on delivery#)}</h3></td>
    </tr>

    <tr>
      <td colspan="2">
        <div>{t(#UPS module supports 'Cash on delivery' feature for shipments within European Union, within United States and Puerto Rico, within Canada and from Canada to the United States.#)}</div>
        <div>{t(#To enable 'Cash on delivery' payment option you should enable payment method 'Cash on delivery (UPS)' at the _Payment methods page_#,_ARRAY_(#URL#^buildURL(#payment_settings#))):h}</div>
      </td>
    </tr>

    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
      <td colspan="2"><h3>{t(#Currency conversion options#)}</h3></td>
    </tr>

    <tr>
      <td><b>{t(#Shipping cost currency#)}:</b></td>
      <td IF="config.XC.UPS.currency_code">{config.XC.UPS.currency_code}</td>
      <td IF="!config.XC.UPS.currency_code">{getCurrencyByCountry()}</td>
    </tr>

    <tr>
      <td><b>{t(#Currency rate#)}:</b></td>
      <td><input type="text" name="currency_rate" value="{config.XC.UPS.currency_rate:r}" size="8" /></td>
    </tr>

    <tr>
      <td colspan="2">{t(#If the UPS returns rates in currency which is differ from the currency the store uses for payments you need to specify the conversion rate to convert the shipping cost returned by UPS into the necessary currency. Otherwise leave 1.#)}</td>
    </tr>

    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>

    <tr>
      <td colspan="2"><h3>{t(#Additional options#)}</h3></td>
    </tr>

    <tr>
      <td><b>{t(#Enable debugging#)}:</b></td>
      <td><input type="checkbox" name="debug_enabled" value="Y"{if:config.XC.UPS.debug_enabled=#Y#} checked="checked"{end:} /></td>
    </tr>

    <tr>
      <td colspan="2">{t(#This option enables logging of all communication between shopping cart and UPS server#)}</td>
    </tr>

    <tr>
      <td></td>
      <td><br /><widget class="\XLite\View\Button\Submit" label="Save" style="action regular-main-button" /></td>
    </tr>

  </table>

</form>

