{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Settings
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:paymentMethod.isConfigured()}

  <div class="stripe configured">

    <p class="status">{t(#Status: Connected#,_ARRAY_(#mode#^getLivemode())):h}</p>

    <p class="note">{t(#Copy Webhook URL and go to Account settings#):h}</p>

    <div class="webhook">
      <div class="url" data-clipboard-text="{paymentMethod.getWebhookURL()}">{paymentMethod.getWebhookURL()}</div>
      <widget class="XLite\View\Tooltip" text="{t(#Webhook URL is your store's URL through which Stripe informs your store about any changes in the order#))}" isImageTag=true className="help-icon" />
      <div class="tooltip" style="display: none;">{t(#URL is copied#)}</div>
    </div>

    <div class="instruction hidden">
      <a href="#" class="switcher show">{t(#Show "How to use" instruction#)}</a>
      <a href="#" class="switcher hide">{t(#Hide "How to use" instruction#)}</a>

      <ul>
        <li class="step-1">
          <div class="number">1</div>
          <p>{t(#Go to your account settings on www.stripe.com#):h}</p>
          <div class="circles">
            <img src="{layout.getResourceWebPath(#modules/XC/Stripe/images/1_screen.png#)}" alt="" />
            <div class="circle circle-1"></div>
          </div>
        </li>
        <li class="step-2">
          <div class="number">2</div>
          <p>{t(#Choose Webhook tab and press + add URL button#):h}</p>
          <div class="circles">
            <img src="{layout.getResourceWebPath(#modules/XC/Stripe/images/2_screen.png#)}" alt="" />
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
          </div>
        </li>
        <li class="step-3">
          <div class="number">3</div>
          <p>{t(#Past Webhook URL to the field and press Create Webhook URL button#):h}</p>
          <div class="circles">
            <img src="{layout.getResourceWebPath(#modules/XC/Stripe/images/3_screen.png#)}" alt="" />
            <div class="circle circle-1"></div>
          </div>
        </li>
      </ul>

    </div>

    <table cellspacing="1" cellpadding="5" class="settings-table">

      <tr>
        <td class="setting-name"><label for="settings_type">{t(#Transaction type#)}</label></td>
        <td>
        <select id="settings_type" name="settings[type]">
          <option value="sale" selected="{isSelected(paymentMethod.getSetting(#type#),#sale#)}">{t(#Authorization and Capture#)}</option>
          <option value="auth" selected="{isSelected(paymentMethod.getSetting(#type#),#auth#)}">{t(#Authorization only#)}</option>
        </select>
        </td>
      </tr>

      <tr>
        <td class="setting-name"><label for="settings_mode">{t(#Processing mode#)}</label></td>
        <td>
          <widget class="\XLite\View\FormField\Select\TestLiveMode" fieldId="settings_mode" fieldName="settings[mode]" fieldOnly=true value="{paymentMethod.getSetting(#mode#)}" />
        </td>
      </tr>

      <tr>
        <td class="setting-name"><label for="settings_prefix">{t(#Invoice number prefix#)}</label></td>
        <td><input type="text" id="settings_prefix" value="{paymentMethod.getSetting(#prefix#)}" name="settings[prefix]" /></td>
      </tr>

      <tr>
        <td>&nbsp;</td>
        <td>
          <div class="buttons">
            <widget class="\XLite\View\Button\Submit" label="{t(#Update#)}" style="regular-main-button" />
            <a href="{buildURL(#stripe_oauth#,#disconnect#)}" class="disconnect">{t(#Disconnect#)}</a>
          </div>
        </td>
      </tr>

    </table>

  </div>

{else:}

  <div class="stripe non-configured">
    <img src="https://stripe.com/img/about/logos/logos/black.png" alt="Stripe" class="logo" />

    {if:!isConnected()}
      <p>{t(#Click Connect with Stripe to be redirected to Stripe.com#)}</p>
      <p>{t(#Fill out the form with your Company info to setup your account and start processing payments immedately#):h}</p>
    {end:}

    <div><widget class="XLite\Module\XC\Stripe\View\Button\Connect" /></div>
  </div>

{end:}
