{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * HTTPS settings page template 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="https-settings-dialog">

  {** top messages **}

  {if:!isEnabledHTTPS()}

  <div class="note top info" IF="isValidSSL()|!isAvailableHTTPS()">
    {t(#The secure protocol for your website is disabled.#)}
  </div>

  <div class="note top warning" IF="isAvailableHTTPS()&!isValidSSL()">
    {t(#The SSL certificate installed on your server is not valid.#)}
  </div>

  <div class="note top" IF="!isAvailableHTTPS()">
    <div class="purchase">
      {t(#To make the online store use the secure protocol you need an SSL certificate purchased for the website domain and installed on your server.#,_ARRAY_(#domain#^getDomain())):h}
    </div>
    <div>
      <widget class="\XLite\View\Button\Regular" label="Purchase SSL certificate" jsCode="window.open('{getPurchaseURL()}','_blank')" style="main-button" />
    </div>
  </div>

  {else:}

  <div class="note top success" IF="isValidSSL()">
    {t(#The secure protocol for your website is enabled.#)}
  </div>

  <div class="note top warning" IF="isAvailableHTTPS()&!isValidSSL()">
    {t(#The secure protocol for your website is enabled, but SSL certificate installed on your server is not valid.#)}
  </div>

  {end:}

  {** buttons **}

  {if:areButtonsEnabled()}

  <div class="actions-block" IF="isAvailableHTTPS()&!isEnabledHTTPS()">
    <widget class="\XLite\View\Button\Regular" label="Enable HTTPS" jsCode="self.location='{buildURL(#https_settings#,#enable_HTTPS#)}'" style="action" />
  </div>

  <div class="actions-block" IF="isEnabledHTTPS()">
    <widget class="\XLite\View\Button\Regular" label="Disable HTTPS" jsCode="self.location='{buildURL(#https_settings#,#disable_HTTPS#)}'" style="action" />
  </div>

  {end:}

  {** bottom messages **}

  <div class="note" IF="isEnabledHTTPS()&isValidSSL()">
    {t(#Your store is configured to use the secure protocol for the store back-end and checkout, sign-in and profile pages.#)}
  </div>

  <div class="note" IF="isAvailableHTTPS()&isValidSSL()&!isEnabledHTTPS()">
    {t(#We have found a valid SSL certificate installed on the server. Now you can switch the store to use the secure protocol for the store back-end and checkout, sign-in and profile pages.#)}
  </div>

  <div class="note" IF="isAvailableHTTPS()&!isValidSSL()">
    <div>
      {t(#The SSL certificate installed on your server is not valid. Although you can switch the store to use the secure protocol for the website pages, most Internet browsers will likely display a warning message scaring your website visitors away.#)}
    </div>
    <div class="purchase">
      {t(#To enable secure protocol for your website pages you need a valid SSL certificate purchased for the website domain and installed on your server.#,_ARRAY_(#domain#^getDomain())):h}
    </div>
    <div><a href="{getPurchaseURL()}" target="_blank">{t(#Purchase SSL certificate#)}<i class="icon fa fa-external-link"></i></a></div>
  </div>

</div>
