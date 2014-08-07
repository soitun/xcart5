{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add PIN codes dialog.
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="\XLite\Module\CDev\PINCodes\View\Form\AddPinCodesDialog" name="add_pin_codes_dialog_form" />

  <div class="add-pin-codes-dialog">
 
    <p>{t(#Please, type in the new PIN codes one per line.#)}</p>
 
    <widget class="\XLite\View\FormField\Textarea\Simple" fieldName="codes" fieldOnly="true" cols="64" />
    <div class="clear"></div>
    <widget class="\XLite\View\Button\Submit" style="action" label="Add pin codes" />

  </div>

<widget name="add_pin_codes_dialog_form" end />
