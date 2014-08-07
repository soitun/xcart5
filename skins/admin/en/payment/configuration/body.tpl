{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Payment configuration
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="payment-conf">

{if:hasPaymentModules()}

  <div IF="hasGateways()" class="box gateways">
    <h2>{t(#Accepting credit card online#)}</h2>
    <div class="content">

      {if:hasAddedGateways()}

        <widget class="XLite\View\ItemsList\Payment\Method\Admin\Gateways" />
        <widget
          class="XLite\View\Button\Payment\AddMethod"
          paymentType={%\XLite\Model\Payment\Method::TYPE_ALLINONE%} style="add-method" />
        <div IF="countNonAddedGateways()" class="counter">{t(#X methods available#,_ARRAY_(#count#^countNonAddedGateways()))}</div>

      {else:}

        <p>{t(#Use a merchant account from your financial institution or choose a bundled payment solution to accept credit cards and other methods of payment on your website.#)}</p>
        <widget
          class="XLite\View\Button\Payment\AddMethod"
          paymentType={%\XLite\Model\Payment\Method::TYPE_ALLINONE%} style="action" />

      {end:}

    </div>
  </div>

  <div IF="hasAlternative()" class="box alternative">
    <h2>{t(#Alternative payment methods#)}</h2>
    <div class="content">

      {if:hasAddedAlternative()}

        <widget class="XLite\View\ItemsList\Payment\Method\Admin\Alternative" />
        <widget
          class="XLite\View\Button\Payment\AddMethod"
          paymentType={%\XLite\Model\Payment\Method::TYPE_ALTERNATIVE%} style="add-method" />
        <div IF="countNonAddedAlternative()" class="counter">{t(#X methods available#,_ARRAY_(#count#^countNonAddedAlternative()))}</div>

      {else:}

        <p>{t(#Give buyers a way to pay by adding an alternative payment method.#)}</p>
        <widget
          class="XLite\View\Button\Payment\AddMethod"
          paymentType={%\XLite\Model\Payment\Method::TYPE_ALTERNATIVE%} style="action"/>

      {end:}

    </div>
  </div>

{else:}

  <div class="box no-payment-modules">
    <h2>{t(#No payment modules installed#)}</h2>
    <div class="content">
      <p>{t(#In order to accept credit cards payments you should install the necessary payment module from our Marketplace.#)}</p>
      <widget class="XLite\View\Button\Link" label="{t(#Go to Marketplace#)}" location="{buildURL(#addons_list_marketplace#,##,_ARRAY_(#tag#^#Payment processing#))}" style="action" />
    </div>
  </div>

  {end:}

  <div class="right-panel-payment-modules">

    <div IF="hasPaymentModules()" class="subbox marketplace">
      <h2>{t(#Need more payment methods?#)}</h2>

      <img src="images/payment_logos.gif" alt="{t(#Payment methods#)}" class="payment-logos" /><br />

      <widget class="XLite\View\Button\Link" label="{t(#Find in Marketplace#)}" location="{buildURL(#addons_list_marketplace#,##,_ARRAY_(#tag#^#Payment processing#))}" style="regular-main-button" />
    </div>

    <div class="subbox watch-video">
      <h2>{t(#Understanding Online Payments#)}</h2>
      <p>{t(#Watch this short video and learn the basics of how online payment processing works#)}</p>
      <widget class="XLite\View\Button\Link" label="{t(#Watch video#)}" location="{getVideoURL()}" style="watch-video" blank="true" />
    </div>
    
  </div>

  <div class="box offline-methods">
  <h2>{t(#Offline methods#)}</h2>
  <div class="content">
    <widget class="XLite\View\ItemsList\Payment\Method\Admin\OfflineModules" />
    <widget class="XLite\View\ItemsList\Payment\Method\Admin\Offline" />
    <widget
      class="XLite\View\Button\Payment\AddMethod"
      paymentType={%\XLite\Model\Payment\Method::TYPE_OFFLINE%} style="add-method" />
  </div>
</div>

</div>
