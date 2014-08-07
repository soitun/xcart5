{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * E-check input form
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<ul class="form clearfix">

  <li class="clearfix">
    <widget class="XLite\View\FormField\Input\Text" fieldName="payment[routing_number]" label="{t(#ABA routing number#)}" required="true" />
  </li>

  <li class="clearfix">
    <widget class="XLite\View\FormField\Input\Text" fieldName="payment[acct_number]" label="{t(#Bank Account Number#)}" required="true" />
  </li>

  <li class="clearfix">
    <widget class="XLite\View\FormField\Select\EcheckType" fieldName="payment[type]" label="{t(#Type of Account#)}" required="true" value="{cart.details.ch_type}" />
  </li>

  <li class="clearfix">
    <widget class="XLite\View\FormField\Input\Text" fieldName="payment[bank_name]" label="{t(#Name of bank at which account is maintained#)}" required="true" />
  </li>

  <li class="clearfix">
    <widget class="XLite\View\FormField\Input\Text" fieldName="payment[acct_name]" label="{t(#Name under which the account is maintained at the bank#)}" required="true" />
  </li>

  <li class="clearfix" IF="processor.isDisplayNumber()">
    <widget class="XLite\View\FormField\Input\Text" fieldName="payment[number]" label="{t(#Check number#)}" required="true" />
  </li>

</ul>
