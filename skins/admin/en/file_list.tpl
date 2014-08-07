{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<table width="100%">
<tr>
<td FOREACH="columns,column,val" width="50%" valign="top">

{foreach:getColumnsData(column),node}

{if:formSelectionName}<input type="radio" name="{formSelectionName}" value="{node.id}" />{end:}
<a href="{node.url:h}" style="font-size:10pt">{if:node.leaf}<img src="images/doc.gif" alt="" />
{else:}<img src="images/folder.gif" alt="" />
{end:}
{node.name}</a>
{if:node.comment}&nbsp;&nbsp;-&nbsp;<span style="font-size:8pt">{node.comment}</span><br />
{else:}
<br />
{end:}

{end:}

</td>
</tr>
</table>
