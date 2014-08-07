{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Payment methods list : left action box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="payment.methods.list.row", weight=100)
 *}

<div class="action left-action">
  {if:canSwitch(method)}
    {if:method.getWarningNote()}

      {if:method.isEnabled()}
        <div class="switch enabled"><img src="images/spacer.gif" alt="{t(#Enabled#)}" /></div>
      {else:}
        <div class="switch disabled" title="{t(#This payment method cannot be enabled until you configure it#)}"><img src="images/spacer.gif" alt="{t(#Disabled#)}" /></div>
      {end:}

    {else:}

      {if:method.isEnabled()}
        <div class="switch enabled"><a href="{buildURL(#payment_settings#,#disable#,_ARRAY_(#id#^method.getMethodId()))}"><img src="images/spacer.gif" alt="{t(#Disable#)}" /></a></div>
      {else:}
        <div class="switch disabled"><a href="{buildURL(#payment_settings#,#enable#,_ARRAY_(#id#^method.getMethodId()))}"><img src="images/spacer.gif" alt="{t(#Enable#)}" /></a></div>
      {end:}

    {end:}

  {else:}

    {if:canEnable(method)}
      <div class="switch enabled" title="{method.getForcedEnabledNote()}"><img src="images/spacer.gif" alt="" /></div>
    {else:}
      <div class="switch disabled" title="{method.getForbidEnableNote()}"><img src="images/spacer.gif" alt="" /></div>
    {end:}

  {end:}

  <img src="images/spacer.gif" class="separator" alt="" />
</div>
