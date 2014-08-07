{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shipping estimator : address
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="shippingEstimator.main", weight="10")
 *}
<widget class="\XLite\View\Form\Cart\ShippingEstimator\Destination" name="destination" className="estimator" />

  <ul class="form">
    <list name="shippingEstimator.address" />
  </ul>

  <div IF="isEstimate()" class="buttons">
    <widget class="\XLite\View\Button\Submit" label="Apply destination" />
  </div>

  <div IF="!isEstimate()" class="buttons main">
    <widget class="\XLite\View\Button\Submit" label="Apply destination"/>
  </div>

<widget name="destination" end />
