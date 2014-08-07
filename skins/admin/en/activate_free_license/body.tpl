{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Activate free license form
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<p class="page-note">{t(#Activate free license description#,_ARRAY_(#purchaseURL#^getPurchaseURL())):h}</p>

<div class="modules-list-box">
  <ul class="update-module-list">
    <li class="update-module-info" FOREACH="getModulesList(),entry">
      <div class="module-icon">
        <img src="{entry.getIconURL()}" alt="{entry.getModuleName()}" />
      </div>
      <ul class="module-info">
        <li class="name">{entry.getModuleName()}</li>
        <li class="module">
          <ul class="details">
            <li class="author">{t(#by#)} {entry.getAuthorName()}</li>
            <li class="enabled" IF="entry.getEnabled()">{t(#enabled#)}</li>
            <li class="disabled" IF="!entry.getEnabled()">{t(#now disabled#)}</li>
          </ul>
        </li>
      </ul>
      <div class="clear"></div>
    </li>
  </ul>
</div>

<div class="clear"></div>

<div class="activate-free-license-form">
  <widget class="XLite\View\Form\ActivateFreeLicense" name="activate_free_license" />
    <widget class="XLite\View\FormField\Input\Text\Email" required="true" fieldName="email" value="{getEmail()}" label="{t(#Email#)}" />
    <widget class="XLite\View\Button\Submit" style="regular-main-button" label="{t(#Activate#)}" />
  <widget name="activate_free_license" end />
</div>