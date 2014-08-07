{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<h2>{t(#Forgot your password?#)}</h2>

<div class="recover-password-message">
  {t(#To recover your password, please type in the valid e-mail address you use as a login#)}
</div>
<div class="recover-password-message">
  {t(#The confirmation URL link will be emailed to you shortly#)}
</div>

<form action="{buildURL()}" method="post" name="recover_password">
  <input type="hidden" name="target" value="recover_password" />
  <input type="hidden" name="action" value="recover_password" />
  <widget class="\XLite\View\FormField\Input\FormId" />

<table class="recover-password-form">

<tr>
    <th class="email-label">{t(#E-mail#)}</th>
    <td class="star">*</td>
    <td class="email-field field">
      <input type="text" name="email" value="{email:r}" size="30" />
    </td>
</tr>

<tr IF="noSuchUser">
    <td colspan="2">&nbsp;</td>
    <td class="error-message">{t(#No such user#)}: {email}</td>
</tr>

<tr>
  <td colspan="3">&nbsp;</td>
</tr>

<tr>
    <td colspan="2">&nbsp;</td>
    <td>
      <widget class="\XLite\View\Button\Submit" style="action" />
    </td>
</tr>

</table>

</form>
