{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Tax edit page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="edit-sales-tax">

  <widget name="editForm" class="\XLite\Module\CDev\SalesTax\View\Form\EditTax" />

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

  <widget class="XLite\Module\CDev\SalesTax\View\ItemsList\Model\Rate" />

  <div class="buttons">
    <widget class="\XLite\View\Button\Submit" label="{t(#Save changes#)}" style="action" />
  </div>

  <widget name="editForm" end />

</div>
