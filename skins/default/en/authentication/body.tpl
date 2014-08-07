{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<table cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;</td>
    <td class="VertMenuItems" valign="top">
      {auth.profile.login}<br />
      {t(#Logged in!#)}<br />
      <br />
      <a href="{buildURL(#login#,#logoff#)}" class="SidebarItems"><img src="images/go.gif" width="13" height="13" border="0" align="middle" alt="">{t(#Log off#)}</a>
      <br />
    </td>
  </tr>
</table>
