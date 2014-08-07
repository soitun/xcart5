{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order "Return products" link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.links", weight="30")
 *}

<li IF="order.isCapostShippingMethod()">
  <widget class="\XLite\Module\XC\CanadaPost\View\Button\PopupReturnProducts" orderId="{order.getOrderId()}" />
</li>
