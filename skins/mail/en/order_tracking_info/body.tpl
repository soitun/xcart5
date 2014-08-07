{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<html>
  <head><title>{t(#Order tracking information#)}</title></head>
<body>
  <p>{t(#Dear X#,_ARRAY_(#firstname#^order.profile.billing_address.firstname,#lastname#^order.profile.billing_address.lastname)):h}</p>

  <p>{t(#Here are the tracking details for your order#,_ARRAY_(#orderNumber#^order.getOrderNumber(),#orderDate#^formatTime(order.getDate()),#orderURL#^orderURL)):h}</p>

  <list name="tracking.info" order="{order}" trackingNumbers="{trackingNumbers}" />

  <p><strong>{t(#Carrier#)}:</strong> {order.getShippingMethodName():h}</p>

  <list name="invoice.base.items" order="{order}" />

{signature:h}
</body>
</html>
