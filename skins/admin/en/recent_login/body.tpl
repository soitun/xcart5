{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * "Recent login" page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="items-list-table items-list">
  <table class="list" cellspacing="0">
    <thead>
      <tr>
        <th>{t(#Date#)}</th>
        <th>{t(#Logged as#)}</th>
      </tr>
    </thead>
    <tbody class="lines">
    {if:recentAdmins}
      <tr FOREACH="recentAdmins,recentAdmin" class="line">
		<td>{formatTime(recentAdmin.last_login):h}</td>
		<td class="main">{recentAdmin.login:h}</td>
	  </tr>
    {end:}
    </tbody>
  </table>
</div>
