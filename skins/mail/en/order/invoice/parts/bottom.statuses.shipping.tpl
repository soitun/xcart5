{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice shipping status
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.bottom.statuses", weight="10")
 *}
<td class="shipping-status" IF="order.getShippingStatus()">
  <br />
  <strong>{t(#Shipping status#)}:</strong>
  {order.shippingStatus.getCustomerName():h}
</td>
