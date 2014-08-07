<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * X-Cart
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the software license agreement
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.x-cart.com/license-agreement.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to licensing@x-cart.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not modify this file if you wish to upgrade X-Cart to newer versions
 * in the future. If you wish to customize X-Cart for your needs please
 * refer to http://www.x-cart.com/ for more information.
 *
 * @category  X-Cart 5
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

namespace XLite\Model\Payment\Base;

/**
 * Abstract credit card-based processor
 */
abstract class CreditCard extends \XLite\Model\Payment\Base\Online
{
    /**
     * Processor operation codes
     */
    const OPERATION_SALE          = 'sale';
    const OPERATION_AUTH          = 'auth';
    const OPERATION_CAPTURE       = 'capture';
    const OPERATION_CAPTURE_PART  = 'capturePart';
    const OPERATION_CAPTURE_MULTI = 'captureMulti';
    const OPERATION_VOID          = 'void';
    const OPERATION_VOID_PART     = 'voidPart';
    const OPERATION_VOID_MULTI    = 'voidMulti';
    const OPERATION_REFUND        = 'refund';
    const OPERATION_REFUND_PART   = 'refundPart';
    const OPERATION_REFUND_MULTI  = 'refundMulti';


    /**
     * Processor transaction type codes
     */
    const TRANSACTION_SALE    = 'sale';
    const TRANSACTION_AUTH    = 'auth';
    const TRANSACTION_CAPTURE = 'capture';
    const TRANSACTION_VOID    = 'void';
    const TRANSACTION_REFUND  = 'refund';


    /**
     * 'Initial trancation type' setting cell name
     */
    const SETTING_INITIAL_TXN_TYPE = 'initialTxnType';


    /**
     * Initial trancation type codes
     */
    const TXN_TYPE_CHARGE = 'sale';
    const TXN_TYPE_AUTH   = 'auth';


    /**
     * Get input template
     *
     * @return string|void
     */
    public function getInputTemplate()
    {
        return 'checkout/credit_card.tpl';
    }

    /**
     * Get operation types
     *
     * @return array
     */
    public function getOperationTypes()
    {
        return array(
            self::OPERATION_SALE,
        );
    }

    /* TODO - rework in next step
    public function getAvailableTransactions(\XLite\Model\Order $order)
    {
        $transactions = array();

        // Add initial transactions

        $openTotal = $order->getOpenTotal();
        if (0 < $openTotal) {
            if (in_array(self::OPERATION_SALE, $this->getOperationTypes())) {
                $transactions[self::TRANSACTION_SALE] = $openTotal;
            }

            if (in_array(self::OPERATION_AUTH, $this->getOperationTypes())) {
                $transactions[self::TRANSACTION_AUTH] = $openTotal;
            }
        }

        $authorized = 0;
        $charged = 0;
        $captured = 0;
        $refunded = 0;
        $voided = 0;

        foreach ($this->getTransactions() as $t) {
            if ($t::STATUS_SUCCESS == $t->getStatus()) {
                switch ($t->getType()) {
                    case self::TRANSACTION_CAPTURE:
                        $captured += $t->getValue();
                        $authorized -= $t->getValue();

                    case self::TRANSACTION_SALE:
                        $charged += $t->getValue();
                        break;

                    case self::TRANSACTION_AUTH:
                        $authorized += $t->getValue();
                        break;

                    case self::TRANSACTION_VOID:
                        $authorized -= $t->getValue();
                        $voided += $t->getValue();
                        break;

                    case self::TRANSACTION_REFUND;
                        $charged -= $t->getValue();
                        $refunded += $t->getValue();
                        break;
                }
            }
        }

        // Detect capture value
        if (0 < $authorized && in_array(self::OPERATION_CAPTURE, $this->getOperationTypes())) {
            if (0 == $captured && 0 == $voided) {
                $transactions[self::TRANSACTION_CAPTURE] = $authorized;

            } elseif (in_array(self::OPERATION_CAPTURE_MULTI, $this->getOperationTypes())) {
                $transactions[self::TRANSACTION_CAPTURE] = $authorized;
            }
        }

        // Detect void value
        if (
            (0 < $authorized && in_array(self::OPERATION_VOID, $this->getOperationTypes()))
            && ((0 == $captured && 0 == $voided) || in_array(self::OPERATION_VOID_MULTI, $this->getOperationTypes()))
        ) {
            $transactions[self::TRANSACTION_VOID] = $authorized;
        }

        // Detect refund valud
        if (
            (0 < $charged && in_array(self::OPERATION_REFUND, $this->getOperationTypes()))
            && (0 == $refunded || in_array(self::OPERATION_REFUND_MULTI, $this->getOperationTypes()))
        ) {
            $transactions[self::TRANSACTION_REFUND] = $charged;
        }

        return $transactions;
    }
    */
}
