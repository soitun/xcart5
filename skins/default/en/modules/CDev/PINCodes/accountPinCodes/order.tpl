{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Account pin codes order 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="order" id="order-{order.getOrderNumber()}">
  <div class="order-items">
    <widget IF="item.countPinCodes()" FOREACH="order.getItems(),item" template="modules/CDev/PINCodes/accountPinCodes/orderItem.tpl" item="{item}" />
  </div>
  <a href="{getOrderUrl()}" target="_blank">{t(#Order#)} #{order.getOrderNumber()}</a> {formatTime(order.date)}
</div>
