{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice payment methods
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.bottom.address.billing", weight="20")
 *}
<div class="method-box">
  <strong class="method-title">{t(#Payment method#)}</strong>
  {if:order.getVisiblePaymentMethods()}
    {foreach:order.getVisiblePaymentMethods(),m}
      {m.getTitle():h}<br />
    {end:}
  {elseif:order.getPaymentMethodName()}
    {t(order.getPaymentMethodName()):h}<br />
  {else:}
    {t(#n/a#)}<br />
  {end:}
</div>