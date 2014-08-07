{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<TABLE border="0" cellpadding="0" cellspacing="0" width="95">
<TR IF={target=active}>
	<TD><IMG src="images/tab_selected_left.gif" width="9" height="42" border="0" alt=""></TD>
	<TD style="padding-bottom: 2px;" width="100%" class="TabSelectedBG" nowrap align="center"><A class="TopTabLink" href="{href:h}"><FONT class="SelectedTab">{label:h}</FONT></A></TD>
	<TD><IMG src="images/tab_selected_right.gif" width="9" height="42" border="0" alt=""></TD>
</TR>
<TR IF={!target=active}>
	<TD><IMG src="images/tab_left.gif" width="9" height="42" border="0" alt=""></TD>
	<TD style="padding-bottom: 2px;" width="100%" class="TabNormalBG" nowrap align="center"><A class="TopTabLink" href="{href:h}">{label:h}</A></TD>
	<TD><IMG src="images/tab_right.gif" width="9" height="42" border="0" alt=""></TD>
</TR>
</TABLE>
