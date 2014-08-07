{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Purchase order input form
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<ul class="form clearfix">

  <li class="clearfix">
    <widget class="XLite\View\FormField\Input\Text" fieldName="payment[number]" label="{t(#Purchase order number#)}" required="true" />
  </li>
  <li class="clearfix">
    <widget class="XLite\View\FormField\Input\Text" fieldName="payment[company]" label="{t(#Company name#)}" required="true" />
  </li>
  <li class="clearfix">
    <widget class="XLite\View\FormField\Input\Text" fieldName="payment[purchaser]" label="{t(#Name of purchaser#)}" required="true" />
  </li>
  <li class="clearfix">
    <widget class="XLite\View\FormField\Input\Text" fieldName="payment[position]" label="{t(#Position#)}" required="true" />
  </li>

</ul>
