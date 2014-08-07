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

  <div class="note top info">
    {t(#It's impossible to detect valid SSL certificate availability on your server because curl extension is not installed.#)}
  </div>

  <div class="actions-block" IF="!isEnabledHTTPS()">
    <widget class="\XLite\View\Button\Regular" label="Enable HTTPS" jsCode="self.location='{buildURL(#https_settings#,#enable_HTTPS#)}'" style="action" />
  </div>

  <div class="actions-block" IF="isEnabledHTTPS()">
    <widget class="\XLite\View\Button\Regular" label="Disable HTTPS" jsCode="self.location='{buildURL(#https_settings#,#disable_HTTPS#)}'" style="action" />
  </div>

</div>
