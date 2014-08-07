{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Cell actions
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 *}

{if:order.isTrackingInformationForm(number.entity)}
<a href="{order.getTrackingInformationURL(entity.value)}?{foreach:order.getTrackingInformationParams(entity.value),name,value}{name}={value}&amp;{end:}" target="_blank">
  <img src="images/truck.svg" class="truck" title="{t(#Track package#)}" alt="{t(#Track package#)}" />
</a>
{else:}
<a href="{order.getTrackingInformationURL(entity.value)}" target="_blank">
  <img src="images/truck.svg" class="truck" title="{t(#Track package#)}" alt="{t(#Track package#)}" />
</a>
{end:}
