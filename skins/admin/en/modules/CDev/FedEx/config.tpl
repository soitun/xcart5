{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<br /><br />
<div class="admin-title">{t(#FedEx settings#)}</div>
<br />

<form action="{buildURL()}" method="post">

  <input type="hidden" name="target" value="fedex" />
  <input type="hidden" name="action" value="update" />
  <widget class="\XLite\View\FormField\Input\FormId" />

  <table class="admin-settings-table" cellspacing="1" cellpadding="3">
    <tbody>

      <tr>
        <td colspan="2"><h3>{t(#Account settings#)}</h3></td>
      </tr>

      <tr>
        <td width="30%">
          {t(#FedEx authentication key#)}
        </td>
        <td width="70%">
          <table cellspacing="0" cellpadding="0">
            <tbody><tr>
                <td>
                  <input type="text" value="{config.CDev.FedEx.key:r}" name="key" size="30" />
                </td>
                <td>
                  &nbsp;
                </td>
              </tr>
          </tbody></table>
        </td>
      </tr>

      <tr>
        <td>
          {t(#FedEx authentication password#)}
        </td>
        <td>
          <table cellspacing="0" cellpadding="0">
            <tbody><tr>
                <td>
                  <input type="password" value="{config.CDev.FedEx.password:r}" id="opt_FEDEX_password" name="password" size="30" />
                </td>
                <td>
                  &nbsp;
                </td>
              </tr>
          </tbody></table>
        </td>
      </tr>

      <tr>
        <td>
         {t(#FedEx account number#)}
        </td>
        <td>
          <table cellspacing="0" cellpadding="0">
            <tbody><tr>
                <td>
                  <input type="text" value="{config.CDev.FedEx.account_number:r}" name="account_number" size="30" />
                </td>
                <td>
                  &nbsp;
                </td>
              </tr>
          </tbody></table>
        </td>
      </tr>

      <tr>
        <td>
          {t(#FedEx meter number#)}
        </td>
        <td>
          <table cellspacing="0" cellpadding="0">
            <tbody><tr>
                <td>
                  <input type="text" value="{config.CDev.FedEx.meter_number:r}" name="meter_number" size="30" />
                </td>
                <td>
                  &nbsp;
                </td>
              </tr>
          </tbody></table>
        </td>
      </tr>

      <tr>
        <td>
          <label for="opt_FEDEX_test_server">{t(#Test mode#)}</label>
        </td>
        <td>
          <table cellspacing="0" cellpadding="0">
            <tbody><tr>
                <td>
                  <input type="checkbox" name="test_mode" id="opt_FEDEX_test_server"{if:config.CDev.FedEx.test_mode=#Y#} checked="checked"{end:} />
                </td>
                <td>
                  &nbsp;
                </td>
              </tr>
          </tbody></table>
        </td>
      </tr>

      <tr>
        <td>
          <label for="opt_FEDEX_debug_enabled">{t(#Enable debugging#)}</label>
        </td>
        <td>
          <table cellspacing="0" cellpadding="0">
            <tbody><tr>
                <td>
                  <input type="checkbox" name="debug_enabled" id="opt_FEDEX_debug_enabled"{if:config.CDev.FedEx.debug_enabled=#Y#} checked="checked"{end:} />
                </td>
                <td>
                  &nbsp;
                </td>
              </tr>
          </tbody></table>
        </td>
      </tr>

      <tr>
        <td colspan="2"><h3>{t(#Shipment options#)}</h3></td>
      </tr>


      <tr><td><strong>{t(#Carrier type(s)#)}:</strong></td></tr>
      <tr>
        <td>{t(#FedEx Express (FDXE)#)}:</td>
        <td>
          <input type="checkbox" value="Y" id="fdxe" name="fdxe" {if:config.CDev.FedEx.fdxe=#Y#} checked="checked"{end:} />
        </td>
      </tr>
      <tr>
        <td>{t(#FedEx Ground (FDXG)#)}:</td>
        <td>
          <input type="checkbox" value="Y" id="fdxg" name="fdxg" {if:config.CDev.FedEx.fdxg=#Y#} checked="checked"{end:} />
        </td>
      </tr>
      <tr>
        <td>{t(#FedEx SmartPost (FXSP)#)}:</td>
        <td>
          <input type="checkbox" value="Y" id="fxsp" name="fxsp" {if:config.CDev.FedEx.fxsp=#Y#} checked="checked"{end:} />
        </td>
      </tr>
      <tr>
        <td><b>{t(#Packaging#)}:</b></td>
        <td>
          <select name="packaging">
            {foreach:getPackagingOptions(),opkey,opval}
            <option value="{opkey}" selected="{isSelected(config.CDev.FedEx.packaging,opkey)}">{opval}</option>
            {end:}
          </select>
        </td>
      </tr>
      <tr>
        <td><b>{t(#Dropoff type#)}:</b></td>
        <td>
          <select name="dropoff_type">
            {foreach:getDropoffTypeOptions(),opkey,opval}
            <option value="{opkey}" selected="{isSelected(config.CDev.FedEx.dropoff_type,opkey)}">{opval}</option>
            {end:}
          </select>
        </td>
      </tr>
      <tr>
        <td><b>{t(#Ship date (days)#)}:</b></td>
        <td>
          <select name="ship_date">
            {foreach:getShipDateOptions(),opkey,opval}
            <option value="{opkey}" selected="{isSelected(config.CDev.FedEx.ship_date,opkey)}">{opval}</option>
            {end:}
          </select>
        </td>
      </tr>
      <tr>
        <td><b>{t(#Currency code#)}:</b></td>
        <td>
          <select name="currency_code">
            {foreach:getCurrencyCodeOptions(),opkey,opval}
            <option value="{opkey}" selected="{isSelected(config.CDev.FedEx.currency_code,opkey)}">{opval}</option>
            {end:}
          </select>
        </td>
      </tr>
      <tr>
        <td><b>{t(#Currency conversion rate#)}:</b></td>
        <td>
          <input type="text" value="{config.CDev.FedEx.currency_rate}" name="currency_rate" size="30" />
        </td>
      </tr>
      <tr>
        <td colspan="2">
        {t(#If the currency specified above differs from the currency which the store uses for payments you need to specify the conversion rate to convert the shipping cost returned by FedEx into the necessary currency. Otherwise leave 1.#)}
        </td>
      </tr>

      <tr>
        <td><b>{t(#Package dimensions (inches)#)}:</b></td>
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
                <td><input type="text" size="6" value="{config.CDev.FedEx.dim_length:r}" name="dim_length" /></td>
                <td>&nbsp;x&nbsp;</td>
                <td><input type="text" size="6" value="{config.CDev.FedEx.dim_width:r}" name="dim_width" /></td>
                <td>&nbsp;x&nbsp;</td>
                <td><input type="text" size="6" value="{config.CDev.FedEx.dim_height:r}" name="dim_height" /></td>
              </tr>
          </tbody></table>
        </td>
      </tr>

    <tr>
      <td><b>{t(#Maximum package weight#)} ({getWeightSymbol()}):</b></td>
      <td><input type="text" name="max_weight" value="{config.CDev.FedEx.max_weight:r}" size="10" /></td>
    </tr>

    <tr>
      <td colspan="2"><br><h3>{t(#Special services#)}</h3></td>
    </tr>
    <tr>
      <td><strong>{t(#Dangerous Goods/Accessibility#)}:</strong></td>
      <td>
          <select name="dg_accessibility">
            <option value="">&nbsp;</option>
            {foreach:getDangerousGoodsOptions(),opkey,opval}
            <option value="{opkey}" selected="{isSelected(config.CDev.FedEx.dg_accessibility,opkey)}">{opval}</option>
            {end:}
          </select>
      </td>
    </tr>
    <tr>
      <td><b>{t(#Signature option#)}:</b></td>
      <td>
          <select name="signature">
            <option value="">&nbsp;</option>
            {foreach:getSignatureOptions(),opkey,opval}
            <option value="{opkey}" selected="{isSelected(config.CDev.FedEx.signature,opkey)}">{opval}</option>
            {end:}
          </select>
      </td>
    </tr>

    <tr>
      <td colspan="2"><br /><h3>{t(#Cash on delivery#)}</h3></td>
    </tr>

    <tr IF="isFedExCODPaymentEnabled()">
      <td colspan="2"><b>{t(#COD is enabled#)}</b></td>
    </tr>

    <tr IF="!isFedExCODPaymentEnabled()">
      <td colspan="2"><b>{t(#COD is disabled#)}</b></td>
    </tr>

    <tr>
      <td colspan="2">
        <div>{t(#Note: To enable/disable 'Cash on delivery' payment option you should enable/disable payment method 'Cash on delivery (FedEx)' at the _Payment methods page_#,_ARRAY_(#URL#^buildURL(#payment_settings#))):h}</div>
      </td>
    </tr>

    <tr IF="isFedExCODPaymentEnabled()">
      <td><b>{t(#C.O.D. type#)}:</b></td>
      <td>
        <select name="cod_type">
          {foreach:getCODTypeOptions(),opkey,opval}
          <option value="{opkey}" selected="{isSelected(config.CDev.FedEx.cod_type,opkey)}">{opval}</option>
          {end:}
        </select>
      </td>
    </tr>

    <tr>
      <td colspan="2"><br /><h3>{t(#Advanced option#)}:</h3></td>
    </tr>
    <tr>
      <td colspan="2">
        <table cellspacing="1" cellpadding="3">
          <tbody>
            <tr>
              <td><input type="checkbox" value="Y" id="opt_saturday_pickup" name="opt_saturday_pickup"{if:config.CDev.FedEx.opt_saturday_pickup=#Y#} checked="checked"{end:} /></td>
              <td><b><label for="opt_saturday_pickup">{t(#Shipment is scheduled for Saturday pickup (option will be used if ship date is Saturday)#)}</label></b></td>
            </tr>
            <tr>
              <td><input type="checkbox" value="Y" id="opt_residential_delivery" name="opt_residential_delivery"{if:config.CDev.FedEx.opt_residential_delivery=#Y#} checked="checked"{end:} /></td>
              <td><b><label for="opt_residential_delivery">{t(#Shipment is from residential address#)}</label></b>
              </td>
            </tr>
            <tr>
              <td><input type="checkbox" value="Y" id="send_insured_value" name="send_insured_value"{if:config.CDev.FedEx.send_insured_value=#Y#} checked="checked"{end:} /></td>
              <td><b><label for="send_insured_value">{t(#Send package cost to calculate insurances#)}</label></b>
              </td>
            </tr>

        </tbody></table>
      </td>
    </tr>

    <tr>
      <td colspan="2"><br /><widget class="\XLite\View\Button\Submit" label="Save" style="regular-main-button action" /></TD>
    </tr>

  </tbody>

</table>

</form>
