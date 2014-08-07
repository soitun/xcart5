{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Credit cards on the invoice
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.bottom.methods", weight="21")
 *}
</tr>
<tr>
  <td>&nbsp;</td>
  <td class="payment" IF="order.getCCData()">

    <strong>{t(#Used credit cards#)}:</strong>

    <br/>

    {foreach:order.getCCData(),cc}
      {cc.card_type} {cc.card_number}<br />
    {end:}

  </td>
</tr>
<tr>
