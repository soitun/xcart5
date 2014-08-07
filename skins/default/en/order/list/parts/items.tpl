{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Orders list items block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="orders.children", weight="20")
 *}
<ul IF="getPageData()" class="list">

  <li FOREACH="getPageData(),order" class="order-{order.order_id}">

    <div class="order-body-item">

      <div class="title">

        <ul class="order-spec-wrapper-list">
        <li class="order-spec-wrapper">{*order number, date, total, num items*}
          <ul class="order-spec">
            <li class="order-switcher"><i data-interval="0" data-toggle="collapse" id="order-{order.orderId}-action" data-target="#order-{order.orderId}" class="fa fa-plus-square-o"></i></li>
            <li class="order-number"><a href="{buildURL(#order#,##,_ARRAY_(#order_number#^order.getOrderNumber()))}">#{order.getOrderNumber()}</a></li>
            <li class="date">{formatTime(order.date)}</li>
            <li class="order-break-line"></li>
            <li class="order-total"><span class="order-spec-label total-label">{t(#Total#)}:</span><span class="order-spec-value total-value">{formatPrice(order.getTotal(),order.getCurrency())}</span></li>
            <li class="order-items-count"><span class="order-spec-label order-items-count-label">{t(#Items#)}:</span><span class="order-spec-value order-items-count-value">{order.countQuantity()}</span></li>
          </ul>
        </li>

        <li class="order-part-wrapper">

        <div class="order-statuses payment-{order.paymentStatus.code} shipping-{order.shippingStatus.code}">
          <ul class="statuses">
            <li class="order-payment-status">
            <widget class="\XLite\View\OrderStatus\Payment" order="{order}" useWrapper="true" />
            </li>
            <li class="order-shipping-status">
            <widget class="\XLite\View\OrderStatus\Shipping" order="{order}" useWrapper="true" />
            </li>
          </ul>
        </div>

        <div class="order-spec-separator"></div>

        <div class="order-actions">
          <ul class="actions-list">
            <li IF="showReorder(order)" class="reorder">
              <widget
                class="\XLite\View\Button\Link"
                label="Re-order"
                location="{buildURL(#cart#,#add_order#,_ARRAY_(#order_number#^order.orderNumber))}"/>
            </li>
          </ul>
        </div>

        </li>
        </ul>

      </div> {*End of title*}

      <div id="order-{order.orderId}" class="order-body-items-list collapse">
        <div class="shipping-method-spec">
          <ul class="shipping-method-name">
            <li class="shipping-method-wrapper">
              <span class="shipping-method-label">{t(#Shipping method#)}:</span><span class="shipping-method-name">{order.getShippingMethodName()}</span>
            </li>
            <li IF="!order.trackingNumbers.isEmpty()" class="tracking-number-wrapper">
              <span class="tracking-number-label">{t(#Tracking numbers#)}:</span>

              <div class="tracking-number-box">
              {foreach:order.trackingNumbers,number}

              <span class="tracking-item">
              {if:order.getTrackingInformationURL(number.value)}
              {if:order.isTrackingInformationForm(number.value)}
              <form method="{order.getTrackingInformationMethod(number.value):h}" action="{order.getTrackingInformationURL(number.value)}" target="_blank" >
              {foreach:order.getTrackingInformationParams(number.value),name,value}
              <input type="hidden" name="{name}" value="{value}" />
              {end:}
              <span>{number.value} - </span>
              <button type="submit">{t(#Track package#)}</button>
              </form>
              {else:}
              <span>{number.value} - </span>
              <a href="{order.getTrackingInformationURL(number.value)}" target="_blank">{t(#Track package#)}</a>
              {end:}
              {else:}
              {number.value}
              {end:}
              </span><br />

              {end:}
              </div>
            </li>

          </ul>
        </div>
        <widget class="\XLite\View\OrderItemsShort" full="true" order="{order}" />
      <div>
    </div>
  </li>
</ul>
