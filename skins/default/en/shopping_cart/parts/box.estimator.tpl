{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shipping estimator box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="estimator">

  {if:isShippingEstimate()}

    <ul>
      <li>
        <span>{t(#Shipping#)}:</span>
        {modifier.method.getName():h} ({getShippingCost()})
      </li>
      <li>
        <span>{t(#Estimated for#)}:</span>
        {getEstimateAddress()}
      </li>
    </ul>

    <div class="link">
      <a href="{buildURL(#shipping_estimate#)}" class="estimate">{t(#Change method#)}</a>
    </div>

  {else:}

    <widget class="\XLite\View\Form\Cart\ShippingEstimator\Open" name="shippingEstimator" />
      <div class="buttons">
        <widget class="\XLite\View\Button\Submit" label="Estimate shipping cost" style="estimate" />
      </div>
    <widget name="shippingEstimator" end />

  {end:}

</div>
