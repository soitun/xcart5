{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shipping estimator : address : state
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="shippingEstimator.address", weight="20")
 *}

<li class="state" IF="hasField(#state_id#)">
  <widget class="\XLite\View\FormField\Select\State" fieldName="destination_state" value="{getState()}" style="field-required" label="{t(#State#)}" required="true" />
</li>

<li class="state" IF="hasField(#state_id#)">
  <widget class="\XLite\View\FormField\Input\Text" fieldName="destination_custom_state" value="{getOtherState()}" label="{t(#State#)}" />
</li>
