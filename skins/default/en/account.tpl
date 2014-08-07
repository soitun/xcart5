{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<table cellpadding=3 cellspacing=0>
  <tr>
    <td>{t(#User X is logged in#,_ARRAY_(#login#^auth.profile.login))}</td>
    <td><widget class="\XLite\View\Button\Link" label="Log off" location="{buildURL(#login#,#logoff#)}" /></td>
  </tr>
  <tr>
    <td colspan=2>&nbsp;</td>
  <tr>
  <tr>
    <td colspan=2>
      <h2>{t(#Account settings#)}</h2>
      <table>
        <tr>
            <td><widget class="\XLite\View\Button\Link" label="Order history" location="{buildURL(#order_list#)}" /></td>
            <td>&nbsp;&nbsp;</td>
            <td><widget class="\XLite\View\Button\Link" label="Modify profile" location="{buildURL(#profile#,##,_ARRAY_(#mode#^#modify#))}" /></td>
            <td>&nbsp;&nbsp;</td>
            <td><widget class="\XLite\View\Button\Link" label="Delete profile" location="{buildURL(#profile#,##,_ARRAY_(#mode#^#delete#))}" /></td>
            <td>&nbsp;&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
