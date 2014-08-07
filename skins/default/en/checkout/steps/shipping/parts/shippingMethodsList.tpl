{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shipping methods list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="\XLite\View\Form\Checkout\ShippingMethod" name="shippingMethod" className="shipping-methods" />

  {if:isShippingAvailable()}

    <widget class="\XLite\View\ShippingList" />

  {else:}

    {if:isAddressCompleted()}
      <p class="shipping-methods-not-avail">{t(#There are no shipping methods available#)}</p>
    {else:}
      <p class="address-not-defined">{t(#Enter the shipping address to see delivery methods available to you#)}</p>
    {end:}

  {end:}

<widget name="shippingMethod" end />
