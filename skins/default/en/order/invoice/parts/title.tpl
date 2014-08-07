{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice title
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.base", weight="20")
 *}
<h2 class="invoice">{t(#Invoice X#,_ARRAY_(#id#^order.getOrderNumber()))}</h2>
<div class="subhead">
  {formatTime(order.getDate())}
  <span>{t(#Grand total#)}: {formatPrice(order.getTotal(),order.getCurrency())}</span>
</div>
