{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order shipping status
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.status", weight="20")
 *}
<div class="shipping order-status-{order.getShippingStatusCode()}"><widget class="\XLite\View\OrderStatus\Shipping" order="{getOrder()}" useWrapper="true" /></div>
