{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * 'More options...' block template (is used in search forms for hiding/displaying an additional search options)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<table cellpadding="2" cellspacing="2">

  <tr>
    <td id="close{mark}" style="{if:visible}display: none; {end:}" onclick="javascript: visibleBox('{mark}');"><img src="images/plus.gif" alt="{t(#Click to open#)}" /></td>
    <td id="open{mark}" style="{if:!visible}display: none; {end:}" onclick="javascript: visibleBox('{mark}');"><img src="images/minus.gif" alt="{t(#Click to close#)}" /></td>
    <td class="table-label"><a href="javascript:void(0);" onclick="javascript: visibleBox('{mark}');"><b>{title}</b></a></td>
  </tr>

</table>
