{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice totals : subtotal
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.base.totals", weight="100")
 *}
<li style="list-style: none;color: #000000;padding: 0px;">
  <div style="display: inline-block;color: #5a5a5a;">{t(#Subtotal#)}:</div>
  <div style="display: inline-block;color: #5a5a5a;">{formatPrice(order.getSubtotal(),order.getCurrency())}</div>
</li>
