{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Tax edit page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="edit-vat-tax">

  <div class="top-note">
    <div>
      {t(#After you enable this tax it will be included in product prices#)}<br />
      {t(#This tax is calculated based on customer's billing address#)}.
    </div>
  </div>

  <widget name="editForm" class="\XLite\Module\CDev\VAT\View\Form\EditTax" />

  <table class="form" cellspacing="0">

    <tr>
      <td class="label"><label for="tax-title">{t(#Tax title#)}:</label></td>
      <td class="star">*</td>
      <td><input type="text" name="name" value="{tax.getName()}" class="field-required" /></td>
      <td class="button {if:tax.getEnabled()}enabled{else:}disabled{end:}">
          <widget class="\XLite\View\Button\SwitchState" label="{t(#Tax enabled#)}" enabled="true" action="switch" />
          <widget class="\XLite\View\Button\SwitchState" label="{t(#Tax disabled#)}" enabled="false" action="switch" />
      </td>
    </tr>

  </table>

  <div class="vat-options">
    <div class="vat-options-block">
      <widget class="\XLite\View\FormField\Input\Checkbox" fieldName="display_prices_including_vat" isChecked="{config.CDev.VAT.display_prices_including_vat=#Y#}" label="{t(#Display prices in catalog including VAT#)}" />
    </div>
    <div class="vat-options-block">
      <widget class="\XLite\Module\CDev\VAT\View\FormField\LabelModeSelector" fieldName="display_inc_vat_label" value="{config.CDev.VAT.display_inc_vat_label}" label="{t(#Display 'inc/ex VAT' labels next to prices#)}" help="{t(#If this option is ticked all prices in the catalog will be shown with 'inc VAT' or 'ex VAT' label depending on whether included VAT into the price or not#)}" />
    </div>
  </div>

  <div class="vat-base">
    <p>{t(#Product prices are defined including this tax calculated for#)}:</p>
    <div>
      <widget class="\XLite\Module\CDev\VAT\View\Taxes\MembershipSelector" field="vatMembership" value="{tax.getVATMembership()}" />
      <span>{t(#and#)}</span>
      <widget class="\XLite\Module\CDev\VAT\View\Taxes\ZoneSelector" field="vatZone" value="{tax.getVATZone()}" />
      <widget
        class="\XLite\View\Tooltip"
        id="vat-help-text"
        text="{t(#Select the membership level and area. for which product prices, including VAT, are defined by the shop administrator#):h}"
        caption=""
        isImageTag="true"
        className="help-icon" />
    </div>
  </div>

  <h2>{t(#Rates / Conditions#)}</h2>

  <widget class="XLite\Module\CDev\VAT\View\ItemsList\Model\Rate" />

  <div class="buttons">
    <widget class="\XLite\View\Button\Submit" label="{t(#Save changes#)}" style="action" />
  </div>

  <widget name="editForm" end />

</div>
