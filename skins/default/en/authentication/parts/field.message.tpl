{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Field : username
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="customer.signin.fields", weight="300")
 * @ListChild (list="customer.signin.popup.fields", weight="300")
 *}

<tr IF="!valid">
    <td>&nbsp;</td>
    <td class="error-message">
      {t(#Invalid login or password#)}
      <a href="{buildURL(#recover_password#)}">{t(#Forgot password#)}?</a>
    </td>
</tr>
