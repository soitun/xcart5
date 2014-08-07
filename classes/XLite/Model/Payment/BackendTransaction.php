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
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

namespace XLite\Model\Payment;

/**
 * Payment backend transaction
 *
 * @Entity
 * @Table  (name="payment_backend_transactions",
 *      indexes={
 *          @Index (name="td", columns={"transaction_id","date"})
 *      }
 * )
 */
class BackendTransaction extends \XLite\Model\AEntity
{
    /**
     * Transaction status codes
     */

    const STATUS_INITIALIZED = 'I';
    const STATUS_INPROGRESS  = 'P';
    const STATUS_SUCCESS     = 'S';
    const STATUS_PENDING     = 'W';
    const STATUS_FAILED      = 'F';

    /**
     * Transaction types
     */

    const TRAN_TYPE_AUTH          = 'auth';
    const TRAN_TYPE_SALE          = 'sale';
    const TRAN_TYPE_CAPTURE       = 'capture';
    const TRAN_TYPE_CAPTURE_PART  = 'capturePart';
    const TRAN_TYPE_CAPTURE_MULTI = 'captureMulti';
    const TRAN_TYPE_VOID          = 'void';
    const TRAN_TYPE_VOID_PART     = 'voidPart';
    const TRAN_TYPE_VOID_MULTI    = 'voidMulti';
    const TRAN_TYPE_REFUND        = 'refund';
    const TRAN_TYPE_REFUND_PART   = 'refundPart';
    const TRAN_TYPE_REFUND_MULTI  = 'refundMulti';
    const TRAN_TYPE_GET_INFO      = 'getInfo';
    const TRAN_TYPE_ACCEPT        = 'accept';
    const TRAN_TYPE_DECLINE       = 'decline';
    const TRAN_TYPE_TEST          = 'test';


    /**
     * Primary key
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer")
     */
    protected $id;

    /**
     * Transaction creation timestamp
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $date;

    /**
     * Status
     *
     * @var string
     *
     * @Column (type="fixedstring", length=1)
     */
    protected $status = self::STATUS_INITIALIZED;

    /**
     * Transaction value
     *
     * @var float
     *
     * @Column (type="decimal", precision=14, scale=4)
     */
    protected $value = 0.0000;

    /**
     * Transaction type
     *
     * @var string
     *
     * @Column (type="string", length=20)
     */
    protected $type;

    /**
     * Payment transactions
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToOne  (targetEntity="XLite\Model\Payment\Transaction", inversedBy="backend_transactions")
     * @JoinColumn (name="transaction_id", referencedColumnName="transaction_id")
     */
    protected $payment_transaction;

    /**
     * Transaction data
     *
     * @var \XLite\Model\Payment\BackendTransactionData
     *
     * @OneToMany (targetEntity="XLite\Model\Payment\BackendTransactionData", mappedBy="transaction", cascade={"all"})
     */
    protected $data;


    /**
     * Get charge value modifier
     *
     * @return float
     */
    public function getChargeValueModifier()
    {
        $value = 0;

        if (!$this->isFailed()) {
            $value += $this->getValue();
        }

        return $value;
    }

    /**
     * Get payment method object related to the parent payment transaction
     *
     * @return \XLite\Model\Payment\Method
     */
    public function getPaymentMethod()
    {
        return $this->getPaymentTransaction()->getPaymentMethod();
    }

    /**
     * Check - transaction is succeed or not
     *
     * @return boolean
     */
    public function isSucceed()
    {
        return static::STATUS_SUCCESS == $this->getStatus();
    }

    /**
     * Check - transaction is failed or not
     *
     * @return boolean
     */
    public function isFailed()
    {
        return static::STATUS_FAILED == $this->getStatus();
    }

    /**
     * Check - order is completed or not
     *
     * @return boolean
     */
    public function isCompleted()
    {
        return static::STATUS_SUCCESS == $this->getStatus();
    }

    /**
     * Check if the backend transaction is of refunded type
     *
     * @return boolean
     */
    public function isRefund()
    {
        return in_array($this->getType(), array(
            static::TRAN_TYPE_REFUND,
            static::TRAN_TYPE_REFUND_MULTI,
            static::TRAN_TYPE_REFUND_PART,
        ));
    }

    /**
     * Check if the backend transaction is of capture type
     *
     * @return boolean
     */
    public function isCapture()
    {
        return in_array($this->getType(), array(
            static::TRAN_TYPE_CAPTURE,
            static::TRAN_TYPE_CAPTURE_MULTI,
            static::TRAN_TYPE_CAPTURE_PART,
        ));
    }

    /**
     * Check if the backend transaction is of void type
     *
     * @return boolean
     */
    public function isVoid()
    {
        return in_array($this->getType(), array(
            static::TRAN_TYPE_VOID,
            static::TRAN_TYPE_VOID_MULTI,
            static::TRAN_TYPE_VOID_PART,
        ));
    }

    /**
     * Constructor
     *
     * @param array $data Entity properties OPTIONAL
     *
     * @return void
     */
    public function __construct(array $data = array())
    {
        $this->data = new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct($data);
    }

    /**
     * Get human-readable status
     *
     * @return string
     */
    public function getReadableStatus()
    {
        return $this->getPaymentTransaction()->getReadableStatus($this->getStatus());
    }

    /**
     * Return true if operation is allowed for currect transaction
     *
     * @param string $operation Name of operation
     *
     * @return boolean
     */
    public function isOperationAllowed($operation)
    {
        return in_array($operation, $this->getPaymentMethod()->getProcessor()->getAllowedTransactions());
    }

    /**
     * Return true if transaction is an initial
     *
     * @return boolean
     */
    public function isInitial()
    {
        return in_array(
            $this->getType(),
            array(
                self::TRAN_TYPE_AUTH,
                self::TRAN_TYPE_SALE,
            )
        );
    }

    // {{{ Data operations

    /**
     * Set data cell
     *
     * @param string $name  Data cell name
     * @param string $value Value
     * @param string $label Public name OPTIONAL
     *
     * @return void
     */
    public function setDataCell($name, $value, $label = null)
    {
        $data = null;

        foreach ($this->getData() as $cell) {
            if ($cell->getName() == $name) {
                $data = $cell;
                break;
            }
        }

        if (!$data) {
            $data = new \XLite\Model\Payment\BackendTransactionData;
            $data->setName($name);
            $this->addData($data);
            $data->setTransaction($this);
        }

        if (!$data->getLabel() && $label) {
            $data->setLabel($label);
        }

        $data->setValue($value);
    }

    /**
     * Get data cell
     *
     * @param string $name Parameter name
     *
     * @return \XLite\Model\Payment\BackendTransactionData
     */
    public function getDataCell($name)
    {
        $value = null;

        foreach ($this->getData() as $cell) {
            if ($cell->getName() == $name) {
                $value = $cell;
                break;
            }
        }

        return $value;
    }

    /**
     * Register transaction in order history
     *
     * @param string $suffix Suffix text to add to the end of event description
     *
     * @return \XLite\Model\Payment\BackendTransaction
     */
    public function registerTransactionInOrderHistory($suffix = null)
    {
        $descrSuffix = !empty($suffix) ? ' [' . static::t($suffix) . ']' : '';

        \XLite\Core\OrderHistory::getInstance()->registerTransaction(
            $this->getPaymentTransaction()->getOrder()->getOrderId(),
            static::t($this->getHistoryEventDescription(), $this->getHistoryEventDescriptionData()) . $descrSuffix,
            $this->getEventData()
        );

        return $this;
    }

    /**
     * Get description of order history event (language label is returned)
     *
     * @return string
     */
    public function getHistoryEventDescription()
    {
        return 'Backend payment transaction X issued';
    }

    /**
     * Get data for description of order history event (substitution data for language label is returned)
     *
     * @return return
     */
    public function getHistoryEventDescriptionData()
    {
        return array(
            'trx_method' => static::t($this->getPaymentMethod()->getName()),
            'trx_type'   => static::t($this->getType()),
            'trx_value'  => $this->getPaymentTransaction()->getOrder()->getCurrency()->roundValue($this->getValue()),
            'trx_status' => static::t($this->getReadableStatus()),
        );
    }

    /**
     * getEventData
     *
     * @return void
     */
    public function getEventData()
    {
        $result = array();

        foreach ($this->getData() as $cell) {
            $result[] = array(
                'name'  => $cell->getLabel() ?: $cell->getName(),
                'value' => $cell->getValue()
            );
        }

        return $result;
    }

    // }}}
}
