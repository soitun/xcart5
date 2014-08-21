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

namespace XLite\Module\MPS\MeritusPayment\Model\Payment\Processor;

/**
 * Meritus Payment Solutions (“MPS”) WebHost processor
 *
 * Meritus payment gateway (CreditCardHosted Method):
 * www.paymentxp.com
 */
class MeritusPayment extends \XLite\Model\Payment\Base\WebBased
{
    /**
     * Currency gateway (only USD)
     */
    const CURRENCY = 'USD';

    /**
     * URL's gateway definition
     */
    const CHECKOUT_API_URL = 'https://webservice.paymentxp.com/wh/EnterPayment.aspx';
    const TRANSACTION_TYPE = 'CreditCardHosted';

    /**
     * Get settings widget or template
     *
     * @return string Widget class name or template path
     */
    public function getSettingsWidget()
    {
        return 'modules/MPS/MeritusPayment/config.tpl';
    }

    /**
     * Check - payment method is configured or not
     *
     * @param \XLite\Model\Payment\Method $method Payment method
     *
     * @return boolean
     */
    public function isConfigured(\XLite\Model\Payment\Method $method)
    {
        return parent::isConfigured($method)
            && $method->getSetting('merchantID')
            && $method->getSetting('merchantKey');
    }

    /**
     * Returns the list of settings available for this payment processor
     *
     * @return array
     */
    public function getAvailableSettings()
    {
        return array(
            'merchantID',
            'merchantKey',
            'orderPrefix',
        );
    }

    /**
     * Get return request owner transaction or null
     *
     * @return \XLite\Model\Payment\Transaction|void
     */
    public function getReturnOwnerTransaction()
    {
        $ReferenceNumber = \XLite\Core\Request::getInstance()->ReferenceNumber;

        $orderPrefix = $this->getSetting('orderPrefix');
        if (!empty($orderPrefix)) {
            $ReferenceNumber = substr_replace($ReferenceNumber, '', 0, strlen($orderPrefix));
        }

        return \XLite\Core\Database::getRepo('XLite\Model\Payment\Transaction')
            ->find($ReferenceNumber);
    }

    /**
     * Get allowed currencies
     *
     * @param \XLite\Model\Payment\Method $method Payment method
     *
     * @return array
     */
    protected function getAllowedCurrencies(\XLite\Model\Payment\Method $method)
    {
        return array_merge(
            parent::getAllowedCurrencies($method),
            array(self::CURRENCY)
        );
    }

    /**
     * Process return
     *
     * @param \XLite\Model\Payment\Transaction $transaction Return-owner transaction
     *
     * @return void
     */
    public function processReturn(\XLite\Model\Payment\Transaction $transaction)
    {
        parent::processReturn($transaction);

        $request = \XLite\Core\Request::getInstance();

        $status = (($request->StatusID == 0 && !isset($request->Status))
            || ($request->StatusID == 1 && isset($request->Status)))
                ? $transaction::STATUS_SUCCESS
                : $transaction::STATUS_FAILED;

        if (!isset($request->Status)) {
            if (!empty($request->ResponseMessage)) {
                $this->transaction->setNote($request->ResponseMessage);
                $this->setDetail('ResponseMessage', $request->ResponseMessage, 'Response Message');
            }
            $this->setDetail('TransactionID', $request->TransactionID, 'Transaction ID');
            $this->setDetail('CVV2ResponseMessage', $request->CVV2ResponseMessage, 'CVV2 Response Message');
            $this->setDetail('AVSResponseMessage', $request->AVSResponseMessage, 'AVS Response Message');
        } else {
            if (!empty($request->Message)) {
                $this->transaction->setNote($request->Message);
                $this->setDetail('Message', $request->Message, 'Message');
            }
            $this->setDetail('TransactionID', $request->TransactionID, 'Transaction ID');
            $this->setDetail('Status', $request->Status, 'Status');
        }

        if (isset($request->TransactionAmount)
            && (!$this->checkTotal($request->TransactionAmount)
            || !$this->checkCurrency(self::CURRENCY))
        ) {
            $status = $transaction::STATUS_FAILED;
        }

        $this->transaction->setStatus($status);
    }

    /**
     * Get payment method admin zone icon URL
     *
     * @param \XLite\Model\Payment\Method $method Payment method
     *
     * @return string
     */
    public function getAdminIconURL(\XLite\Model\Payment\Method $method)
    {
        return true;
    }

    /**
     * Get redirect form URL
     *
     * @return string
     */
    protected function getFormURL()
    {
        return self::CHECKOUT_API_URL;
    }

    /**
     * Get redirect form fields list
     *
     * @return array
     */
    protected function getFormFields()
    {
        $order = $this->getOrder();

        $fields = array(
            'TransactionType' => self::TRANSACTION_TYPE,
            'MerchantID' => $this->getSetting('merchantID'),
            'MerchantKey' => $this->getSetting('merchantKey'),
            'TransactionAmount' => $this->transaction->getValue(),
            'ReferenceNumber' => $this->getSetting('orderPrefix') . $this->transaction->getTransactionId(),
            'BillingNameFirst' => $this->getProfile()->getBillingAddress()->getFirstname(),
            'BillingNameLast' => $this->getProfile()->getBillingAddress()->getLastname(),
            'BillingFullName' => $this->getProfile()->getBillingAddress()->getFirstname()
                . ' ' . $this->getProfile()->getBillingAddress()->getLastname(),
            'BillingAddress' => $this->getProfile()->getBillingAddress()->getStreet(),
            'BillingZipCode' => $this->getProfile()->getBillingAddress()->getZipcode(),
            'BillingCity' => $this->getProfile()->getBillingAddress()->getCity(),
            'BillingState' => $this->getProfile()->getBillingAddress()->getState()->getCode(),
            'BillingCountry' => $this->getProfile()->getBillingAddress()->getCountry()->getCode(),
            'EmailAddress' => $this->getProfile()->getLogin(),
            'PhoneNumber' => $this->getProfile()->getBillingAddress()->getPhone(),
            'ClientIPAddress' => $this->getClientIP(),
            'ProductDescription' => 'Order #' . $this->getOrder()->getOrderNumber(),
            'PostBackURL' => $this->getReturnURL(),
        );

        if ($shippingAddress = $this->getProfile()->getShippingAddress()) {

            $fields += array(

                'ShippingAddress1' => $shippingAddress->getStreet(),
                'ShippingAddress2' => $userinfo['s_address_2'],
                'ShippingCity' => $shippingAddress->getCity(),
                'ShippingState' => $shippingAddress->getState()->getCode(),
                'ShippingZipCode' => $shippingAddress->getZipcode(),
                'ShippingCountry' => $shippingAddress->getCountry()->getCode(),
            );
        }

        return $fields;
    }

    /**
     * Get setting value by name
     *
     * @param string $name Name
     *
     * @return mixed
     */
    protected function getSetting($name)
    {
        return (parent::getSetting($name))
            ?: $this->getMeritusPaymentMethod()->getSetting($name);
    }

    /**
     * Get payment method
     *
     * @return \XLite\Model\Payment\Method
     */
    protected function getMeritusPaymentMethod()
    {
        return \XLite\Core\Database::getRepo('XLite\Model\Payment\Method')
            ->findOneBy(
                array(
                    'service_name' => \XLite\Module\MPS\MeritusPayment\Main::METHOD_SERVICE_NAME
                )
            );
    }
}
