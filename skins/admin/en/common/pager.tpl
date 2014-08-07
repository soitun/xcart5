{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<p IF="moreThanOnePage" class="navigation-path">
<table width="90%">
<tr>
<td>
{t(#Result pages#)}:&nbsp;{foreach:pageURLs,num,pageURL}{if:isCurrentPage(num)}<b>[{num}]</b>{else:}<a href="{pageURL:h}">[{num}]</a>{end:} {end:}
</td>
</tr>
</table>
</p>
