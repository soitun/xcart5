{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="tracking.info", weight="10")
 *}

<p style="font-weight: bold;">{t(#Tracking numbers#)}:</p>

{foreach:trackingNumbers,number}
<div>
{if:order.getTrackingInformationURL(number.value)}
{if:order.isTrackingInformationForm(number.value)}
<form method="{order.getTrackingInformationMethod(number.value):h}" action="{order.getTrackingInformationURL(number.value)}" target="_blank" >
{foreach:order.getTrackingInformationParams(number.value),name,value}
<input type="hidden" name="{name}" value="{value}" />
{end:}
<span>{number.value} - </span>
<button type="submit">{t(#Track package#)}</button>
</form>
{else:}
<span>{number.value} - </span>
<a href="{order.getTrackingInformationURL(number.value)}" target="_blank">{t(#Track package#)}</a>
{end:}
{else:}
{number.value}
{end:}
</div>
{end:}
