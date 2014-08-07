{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Recover password : form : button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="recover.password.fields", weight="300")
 *}

<tr>
  <td colspan="2">&nbsp;</td>
  <td class="buttons">
    <widget class="\XLite\View\Button\Submit" />
    <a href="{buildURL(#login#)}" class="back-login log-in" data-login="{email}">{t(#Back to Login form#)}</a>
  </td>
</tr>

