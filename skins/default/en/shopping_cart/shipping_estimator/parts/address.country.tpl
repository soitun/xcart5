{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shipping estimator : address : country
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="shippingEstimator.address", weight="10")
 *}

<li class="country" IF="hasField(#country_code#)">
  <widget class="\XLite\View\FormField\Select\Country" fieldName="destination_country" value="{getCountryCode()}" stateSelectorId="destination-state" stateInputId="destination-custom-state" label="{t(#Country#)}" required="true" />
</li>
