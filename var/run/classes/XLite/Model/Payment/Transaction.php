<?php

namespace XLite\Model\Payment;

/**
 * Payment transaction
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Payment\Transaction")
 * @Table  (name="payment_transactions",
 *      indexes={
 *          @Index (name="status", columns={"status"}),
 *          @Index (name="o", columns={"order_id","status"}),
 *          @Index (name="pm", columns={"method_id","status"})
 *      }
 * )
 */
class Transaction extends \XLite\Module\CDev\XPaymentsConnector\Model\Payment\Transaction
{
}