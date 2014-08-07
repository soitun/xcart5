{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Payment transaction PNREF and PPREF (for PayPal transactions only)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="order.payment", weight="110")
 *}

<div class="pp-transaction-ids" IF="order.getTransactionIds()">
  {foreach:order.getTransactionIds(),tid}
  <div>
    {tid.name}:
    {if:tid.url}
    <a href="{tid.url}">{tid.value}</a>
    {else:}
    {tid.value}
    {end:}
  </div>
  {end:}
</div>
