{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Recover password : form : user
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="recover.password.fields", weight="200")
 *}

<tr IF="noSuchUser">
  <td colspan="2">&nbsp;</td>
  <td class="error-message">{t(#No such user#)}: {email}</td>
</tr>
