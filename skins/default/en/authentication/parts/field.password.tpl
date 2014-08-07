{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Field : password
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="customer.signin.fields", weight="200")
 * @ListChild (list="customer.signin.popup.fields", weight="200")
 *}

<tr>
  <td class="password-label"><label for="login-password">{t(#Password#)}:</label></td>
  <td class="password-field field">
    <widget class="XLite\View\FormField\Input\Password" required="true" fieldName="password" label="{t(#Password#)}" fieldOnly="true" fieldId="login-password" />
  </td>
</tr>
