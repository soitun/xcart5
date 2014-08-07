{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Recover password : form : email
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="recover.password.fields", weight="100")
 *}

<tr>
  <td class="email-label label"><label for="email">{t(#Email#)}</label></td>
  <td class="star"></td>
  <td class="email-field field">
    <widget class="XLite\View\FormField\Input\Text\Email" value="{email}" required="true" fieldName="email" label="{t(#Email#)}" fieldOnly="true" />
  </td>
</tr>
