{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice payment status
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.bottom.statuses", weight="20")
 *}
<td class="payment-status" IF="order.getPaymentStatus()">
  <br />
  <strong>{t(#Payment status#)}:</strong>
  {order.paymentStatus.getCustomerName():h}
</td>
