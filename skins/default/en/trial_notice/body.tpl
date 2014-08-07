{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Trial notice popup dialog
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="trial-notice-form alert alert-warning">

  <div class="indent title">{t(#Your X-Cart 5 installation is licensed for evaluation purposes only.#)}</div>

  <div class="indent">{t(#You must register your installation before you can use it for real sales#)}</div>

  <div class="buttons">

    <widget IF="isLoggedAdmin()" class="\XLite\View\Button\Regular" label="Purchase premium license" style="regular-main-button purchase-button" jsCode="window.open('{getPurchaseURL()}', '_blank');" />
    <widget IF="!isLoggedAdmin()" class="\XLite\View\Button\Regular" label="Purchase premium license" style="regular-main-button purchase-button" jsCode="window.open('{getAdminURL()}', '_blank');" />

    <div class="text or">{t(#or#)}</div>

    <widget class="\XLite\View\Button\Regular" label="Activate free license" style="regular-button" jsCode="window.open('{getAdminURL()}?target=activate_free_license', '_blank');" />

    <div class="text">{t(#Contact us trial notice#,_ARRAY_(#contactURL#^getContactUsURL())):h}</div>

  </div>

  <div class="indent faq">{t(#For details refer to X-Cart license#,_ARRAY_(#licenseAgreementURL#^getLicenseAgreementURL())):h}</div>

  <div class="indent important">{t(#Removal of this message is allowed only through activation of a free or premium license.#)}</div>

  <div class="clear"></div>
</div>
