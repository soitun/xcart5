{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules enter key form
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="enter-addon-key-form">

  <widget class="\XLite\View\Form\Module\ModuleKey" formAction="register_key" name="activate_key_form" />

    <div class="enter-key-hint">{t(#To activate your X-Cart 5 or commercial module license, enter your license key into the field below and click Activate.#)}</div>

    <div class="addon-key"><input type="text" name="key" value="" placeholder="{t(#Enter license key#)}" /></div>

    <widget class="\XLite\View\Button\Submit" style="regular-main-button" label="{t(#Activate#)}" />

    <div class="clear"></div>

  <widget name="activate_key_form" end />

</div>
