{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Field : username
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="customer.signin.fields", weight="100")
 * @ListChild (list="customer.signin.popup.fields", weight="100")
 *}

<tr>
  <td class="email-label"><label for="login-email">{t(#Email#)}:</label></td>
  <td class="email-field field">
    <widget class="XLite\View\FormField\Input\Text\Email" value="{login}" required="true" fieldName="login" label="{t(#Email#)}" fieldOnly="true" fieldId="login-email" />
  </td>
</tr>
