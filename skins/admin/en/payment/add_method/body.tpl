{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add payment type widget
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="add-payment-box payment-type-{getPaymentType()}">

  <ul IF="%\XLite\Model\Payment\Method::TYPE_ALLINONE%=getPaymentType()" class="tabs-container">

    <li class="headers">
      <ul>
        <li class="header all-in-one-solutions selected">
          <div class="header-wrapper">
            <div class="main-head">{t(#All-in-one solutions#)}</div>
            <div class="small-head">{t(#No merchant account required#)}</div>
          </div>
        </li>
        <li class="header payment-gateways">
          <div class="header-wrapper">
            <div class="main-head">{t(#Payment gateways#)}</div>
            <div class="small-head">{t(#Requires registered merchant account#)}</div>
          </div>
        </li>
      </ul>
    </li>

    <li class="body">
      <ul>
        <li class="body-item all-in-one-solutions selected">
          <div class="body-box">
            <div class="everything-you-need">{t(#Everything you need#)}</div>
            <div class="description">{t(#Choose from a variety of bundled payment solutions to accept credit cards and other methods of payment on your website#)}</div>

            <widget class="\XLite\View\Payment\MethodsPopupList" paymentType={%\XLite\Model\Payment\Method::TYPE_ALLINONE%} />

            <widget class="\XLite\View\Payment\MarketplaceBlock"/>
          </div>
        </li>

        <li class="body-item payment-gateways">
          <div class="body-box">
            <div class="everything-you-need">{t(#Join forces with your bank#)}</div>
            <div class="description">{t(#Use a merchant account from your financial institution to accept online payments#)}</div>

            <widget class="\XLite\View\Payment\MethodsPopupList" paymentType={%\XLite\Model\Payment\Method::TYPE_CC_GATEWAY%} />

            <widget class="\XLite\View\Payment\MarketplaceBlock"/>
          </div>
        </li>
      </ul>
    </li>

  </ul>

  <ul IF="%\XLite\Model\Payment\Method::TYPE_ALTERNATIVE%=getPaymentType()" class="tabs-container alternative-methods">
    <li class="alternative selected tab">
      <ul>
        <li class="body">
          <div class="body-box">
            <div class="everything-you-need">{t(#Quick and easy setup#)}</div>
            <div class="description">{t(#Give buyers another way to pay by adding an alternative payment method#)}</div>

            <widget class="\XLite\View\Payment\MethodsPopupList" paymentType={%\XLite\Model\Payment\Method::TYPE_ALTERNATIVE%} />

            <widget class="\XLite\View\Payment\MarketplaceBlock"/>
          </div>
        </li>
      </ul>
    </li>
  </ul>

  <ul IF="%\XLite\Model\Payment\Method::TYPE_OFFLINE%=getPaymentType()" class="offline-methods tabs-container">
    <li class="offline selected tab">
      <ul>
        <li class="body">
          <list name="payment.method.add.offline" />
        </li>
      </ul>
    </li>
  </ul>

</div>
