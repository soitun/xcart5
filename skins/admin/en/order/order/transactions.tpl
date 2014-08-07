{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order transactions
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<tr>
  <td>{t(#Payment transactions#)}:</td>
  <td>

<ul class="transactions">
  <li FOREACH="getTransactions(),index,transaction">
    <div class="id">#{transaction.getTransactionId()}{if:transaction.getPublicId()} / {transaction.getPublicId()}{end:}</div>
    <div class="transaction-type">{transaction.getType()}</div>
    <div class="status">{getTransactionStatus(transaction)}</div>
    <div class="value"><strong>{t(#Value#)}:</strong><span>{order.currency.formatValue(transaction.value)}</span></div>
    <ul class="data" IF="getTransactionData(transaction)">
      <li FOREACH="getTransactionData(transaction),cell">
        <strong>{cell.getLabel()}:</strong>
        <span>{cell.getValue()}</span>
      </li>
    </ul>
  </li>
</ul>

  </td>
</tr>
