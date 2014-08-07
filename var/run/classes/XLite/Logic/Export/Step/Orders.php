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

namespace XLite\Logic\Export\Step;

/**
 * Orders
 */
class Orders extends \XLite\Logic\Export\Step\AStep
{
    /**
     * Prefixes names
     */
    const CUSTOMER_PREFIX            = 'customer';
    const ITEM_PREFIX                = 'item';
    const SURCHARGE_PREFIX           = 'surcharge';
    const PAYMENT_TRANSACTION_PREFIX = 'paymentTransaction';
    const ADDRESS_FIELD_SUFFIX       = 'AddressField';
    const TRACKING_NUMBER_SUFFIX     = 'TrackingNumber';

    // {{{ Data

    /**
     * Get repository
     *
     * @return \XLite\Model\Repo\ARepo
     */
    protected function getRepository()
    {
        return \XLite\Core\Database::getRepo('XLite\Model\Order');
    }

    /**
     * Get model datasets
     *
     * @param \XLite\Model\AEntity $model Model
     *
     * @return array
     */
    protected function getModelDatasets(\XLite\Model\AEntity $model)
    {
        $datasets = $this->distributeDatasetModel(
            parent::getModelDatasets($model),
            'detail',
            $model->getDetails()
        );

        $datasets = $this->distributeDatasetModel(
            $datasets,
            'item',
            $model->getItems()
        );

        $datasets = $this->distributeDatasetModel(
            $datasets,
            'paymentTransaction',
            $model->getPaymentTransactions()
        );

        return $datasets;
    }

    // }}}

    // {{{ Columns

    /**
     * Define columns
     *
     * @return array
     */
    protected function defineColumns()
    {
        $columns = array(
            'orderNumber'                           => array(),
            static::CUSTOMER_PREFIX . 'Email'       => array(),
            static::CUSTOMER_PREFIX . 'Anonymous'   => array(),
            static::CUSTOMER_PREFIX . 'AddressSame' => array(),
        );

        foreach(\XLite\Core\Database::getRepo('XLite\Model\AddressField')->findAllEnabled() as $field) {
            $name = ucfirst(\XLite\Core\Converter::convertToCamelCase($field->getServiceName()));
            $columns[static::CUSTOMER_PREFIX . $name . 'Billing' . static::ADDRESS_FIELD_SUFFIX] = array(
                static::COLUMN_GETTER    => 'getBillingAddressFieldValue',
                static::COLUMN_FORMATTER => 'formatBillingAddressFieldValue',
            );
        }

        foreach(\XLite\Core\Database::getRepo('XLite\Model\AddressField')->findAllEnabled() as $field) {
            $name = ucfirst(\XLite\Core\Converter::convertToCamelCase($field->getServiceName()));
            $columns[static::CUSTOMER_PREFIX . $name . 'Shipping' . static::ADDRESS_FIELD_SUFFIX] = array(
                static::COLUMN_GETTER    => 'getShippingAddressFieldValue',
                static::COLUMN_FORMATTER => 'formatShippingAddressFieldValue',
            );
        }

        $columns += array(
            static::ITEM_PREFIX . 'Name'            => array(static::COLUMN_MULTIPLE => true),
            static::ITEM_PREFIX . 'SKU'             => array(static::COLUMN_MULTIPLE => true),
            static::ITEM_PREFIX . 'Price'           => array(static::COLUMN_MULTIPLE => true),
            static::ITEM_PREFIX . 'Quantity'        => array(static::COLUMN_MULTIPLE => true),
            static::ITEM_PREFIX . 'Subtotal'        => array(static::COLUMN_MULTIPLE => true),
        );

        foreach ($this->getOrderItemSurchargeTypes() as $type) {
            $columns[$type['name'] . ' (item surcharge)'] = array(
                'type'                  => $type,
                static::COLUMN_GETTER   => 'getOrderItemSurchargeColumnValue',
                static::COLUMN_MULTIPLE => true,
            );
        }

        $columns += array(
            static::ITEM_PREFIX . 'Total'           => array(static::COLUMN_MULTIPLE => true),
            'subtotal'                              => array(),
        );

        foreach ($this->getOrderSurchargeTypes() as $type) {
            $columns[$type['name'] . ' (surcharge)'] = array(
                'type'                  => $type,
                static::COLUMN_GETTER   => 'getOrderSurchargeColumnValue',
            );
        }

        $columns += array(
            'total'                                 => array(),
            'currency'                              => array(),
            'shippingMethod'                        => array(),
            'trackingNumber'                        => array(),
            static::PAYMENT_TRANSACTION_PREFIX . 'Method' => array(static::COLUMN_MULTIPLE => true),
            static::PAYMENT_TRANSACTION_PREFIX . 'Status' => array(static::COLUMN_MULTIPLE => true),
            static::PAYMENT_TRANSACTION_PREFIX . 'Value'  => array(static::COLUMN_MULTIPLE => true),
            static::PAYMENT_TRANSACTION_PREFIX . 'Note'   => array(static::COLUMN_MULTIPLE => true),
            static::PAYMENT_TRANSACTION_PREFIX . 'Type'   => array(static::COLUMN_MULTIPLE => true),
            static::PAYMENT_TRANSACTION_PREFIX . 'Id'     => array(static::COLUMN_MULTIPLE => true),
            static::PAYMENT_TRANSACTION_PREFIX . 'Data'   => array(static::COLUMN_MULTIPLE => true),
            'date'                                  => array(),
            'paymentStatus'                         => array(),
            'shippingStatus'                        => array(),
            'notes'                                 => array(),
            'adminNotes'                            => array(),
            'detailCode'                            => array(static::COLUMN_MULTIPLE => true),
            'detailLabel'                           => array(static::COLUMN_MULTIPLE => true),
            'detailValue'                           => array(static::COLUMN_MULTIPLE => true),
        );

        return $columns;
    }

    /**
     * Get order surcharge types
     *
     * @return array
     */
    protected function getOrderSurchargeTypes()
    {
        return \XLite\Core\Database::getRepo('XLite\Model\Order\Surcharge')->getExistsTypes();
    }

    /**
     * Get order item surcharge types
     *
     * @return void
     */
    protected function getOrderItemSurchargeTypes()
    {
        return \XLite\Core\Database::getRepo('XLite\Model\OrderItem\Surcharge')->getExistsTypes();
    }

    // }}}

    // {{{ Getters and formatters

    /**
     * Get column value for 'orderNumber' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getOrderNumberColumnValue(array $dataset, $name, $i)
    {
        return $this->getColumnValueByName($dataset['model'], 'orderNumber');
    }

    /**
     * Get column value for 'shippingMethod' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getShippingMethodColumnValue(array $dataset, $name, $i)
    {
        $result = $this->getColumnValueByName($dataset['model'], 'shipping_method_name');
        if (!$result && $dataset['model']->getShippingId()) {
            $shipping = \XLite\Core\Database::getRepo('XLite\Model\Shipping\Method')->find($dataset['model']->getShippingId());
            if ($shipping) {
                $result = $shipping->getName();
            }
        }

        return $result;
    }

    /**
     * Get column value for 'trackingNumber' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getTrackingNumberColumnValue(array $dataset, $name, $i)
    {
        $trackingNumbers = array();
        foreach ($dataset['model']->getTrackingNumbers() as $number) {
            $trackingNumbers[] = $number->getValue();
        }

        return implode(', ', $trackingNumbers);
    }

    /**
     * Get column value for 'date' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getDateColumnValue(array $dataset, $name, $i)
    {
        return $this->getColumnValueByName($dataset['model'], 'date');
    }

    /**
     * Format 'date' field value
     *
     * @param mixed  $value   Value
     * @param array  $dataset Dataset
     * @param string $name    Column name
     *
     * @return string
     */
    protected function formatDateColumnValue($value, array $dataset, $name)
    {
        return $this->formatTimestamp($value);
    }

    /**
     * Get column value for 'paymentStatus' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getPaymentStatusColumnValue(array $dataset, $name, $i)
    {
        return $dataset['model']->getPaymentStatusCode();
    }

    /**
     * Get column value for 'shippingStatus' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getShippingStatusColumnValue(array $dataset, $name, $i)
    {
        return $dataset['model']->getShippingStatusCode();
    }

    /**
     * Get column value for 'notes' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getNotesColumnValue(array $dataset, $name, $i)
    {
        return $this->getColumnValueByName($dataset['model'], 'notes');
    }

    /**
     * Get column value for 'adminNotes' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getAdminNotesColumnValue(array $dataset, $name, $i)
    {
        return $this->getColumnValueByName($dataset['model'], 'adminNotes');
    }

    /**
     * Get column value for 'customerEmail' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getCustomerEmailColumnValue(array $dataset, $name, $i)
    {
        return $this->getColumnValueByName($dataset['model']->getProfile(), 'login');
    }

    /**
     * Get column value for 'customerAnonymous' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getCustomerAnonymousColumnValue(array $dataset, $name, $i)
    {
        return $dataset['model']->getOrigProfile() && $dataset['model']->getOrigProfile()->getOrder();
    }

    /**
     * Get column value for 'customerAddressSame' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getCustomerAddressSameColumnValue(array $dataset, $name, $i)
    {
        return $dataset['model']->getProfile()->isSameAddress();
    }

    /**
     * Get column value for abstract billing address column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getBillingAddressFieldValue(array $dataset, $name)
    {
        $address = $dataset['model']->getProfile()->getBillingAddress();

        return empty($address)
            ? ''
            : $address->getterProperty(substr($name, strlen(static::CUSTOMER_PREFIX), strlen('Billing' . static::ADDRESS_FIELD_SUFFIX) * -1));
    }

    /**
     * Format billing address field value
     *
     * @param mixed  $value   Value
     * @param array  $dataset Dataset
     * @param string $name    Column name
     *
     * @return string
     */
    protected function formatBillingAddressFieldValue($value, array $dataset, $name)
    {
        return $value;
    }

    /**
     * Get column value for abstract shipping address column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getShippingAddressFieldValue(array $dataset, $name)
    {
        $address = $dataset['model']->getProfile()->getShippingAddress();

        return empty($address) && !$dataset['model']->getProfile()->isSameAddress()
            ? ''
            : $address->getterProperty(substr($name, strlen(static::CUSTOMER_PREFIX), strlen('Shipping' . static::ADDRESS_FIELD_SUFFIX) * -1));
    }

    /**
     * Format shipping address field value
     *
     * @param mixed  $value   Value
     * @param array  $dataset Dataset
     * @param string $name    Column name
     *
     * @return string
     */
    protected function formatShippingAddressFieldValue($value, array $dataset, $name)
    {
        return $value;
    }

    /**
     * Get column value for 'detailCode' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getDetailCodeColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['detail']) ? '' : $this->getColumnValueByName($dataset['detail'], 'name');
    }

    /**
     * Get column value for 'detailLabel' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getDetailLabelColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['detail']) ? '' : $this->getColumnValueByName($dataset['detail'], 'label');
    }

    /**
     * Get column value for 'detailValue' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getDetailValueColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['detail']) ? '' : $this->getColumnValueByName($dataset['detail'], 'value');
    }

    /**
     * Get column value for 'currency' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getCurrencyColumnValue(array $dataset, $name, $i)
    {
        return $this->getColumnValueByName($dataset['model']->getCurrency(), 'code');
    }

    /**
     * Get column value for 'itemName' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getItemNameColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['item'])
            ? ''
            : $this->getColumnValueByName($dataset['item'], 'name');
    }

    /**
     * Get column value for 'itemSKU' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getItemSKUColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['item'])
            ? ''
            : $this->getColumnValueByName($dataset['item'], 'sku');
    }

    /**
     * Get column value for 'itemPrice' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getItemPriceColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['item'])
            ? ''
            : $this->getColumnValueByName($dataset['item'], 'price');
    }

    /**
     * Get column value for 'itemQuantity' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getItemQuantityColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['item'])
            ? ''
            : $this->getColumnValueByName($dataset['item'], 'amount');
    }

    /**
     * Get column value for 'itemSubtotal' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getItemSubtotalColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['item'])
            ? ''
            : $this->getColumnValueByName($dataset['item'], 'subtotal');
    }

    /**
     * Get column value for 'itemTotal' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getItemTotalColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['item'])
            ? ''
            : $this->getColumnValueByName($dataset['item'], 'total');
    }

    /**
     * Get column value for 'subtotal' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getSubtotalColumnValue(array $dataset, $name, $i)
    {
        return $this->getColumnValueByName($dataset['model'], 'subtotal');
    }

    /**
     * Get column value for 'total' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getTotalColumnValue(array $dataset, $name, $i)
    {
        return $this->getColumnValueByName($dataset['model'], 'total');
    }

    /**
     * Get column value for order item surcharge column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getOrderItemSurchargeColumnValue(array $dataset, $name, $i)
    {
        $sum = 0;

        if (!empty($dataset['item'])) {
            $columns = $this->getColumns();
            $column = $columns[$name];

            foreach ($dataset['item']->getSurcharges() as $surcharge) {
                if (
                    $surcharge->getCode() == $column['type']['code']
                    && $surcharge->getType() == $column['type']['type']
                ) {
                    $sum += $surcharge->getValue();
                }
            }
        }

        return $sum ? $sum : '';
    }

    /**
     * Get column value for order surcharge column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getOrderSurchargeColumnValue(array $dataset, $name, $i)
    {
        $columns = $this->getColumns();
        $column = $columns[$name];

        $sum = 0;
        foreach ($dataset['model']->getSurcharges() as $surcharge) {
            if (
                $surcharge->getCode() == $column['type']['code']
                && $surcharge->getType() == $column['type']['type']
            ) {
                $sum += $surcharge->getValue();
            }
        }

        return $sum ? $sum : '';
    }

    /**
     * Get column value for 'paymentTransactionMethod' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getPaymentTransactionMethodColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['paymentTransaction'])
            ? ''
            : $this->getColumnValueByName($dataset['paymentTransaction'], 'method_name');
    }

    /**
     * Get column value for 'paymentTransactionStatus' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getPaymentTransactionStatusColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['paymentTransaction'])
            ? ''
            : $this->getColumnValueByName($dataset['paymentTransaction'], 'status');
    }

    /**
     * Get column value for 'paymentTransactionValue' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getPaymentTransactionValueColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['paymentTransaction'])
            ? ''
            : $this->getColumnValueByName($dataset['paymentTransaction'], 'value');
    }

    /**
     * Get column value for 'paymentTransactionNote' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getPaymentTransactionNoteColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['paymentTransaction'])
            ? ''
            : $this->getColumnValueByName($dataset['paymentTransaction'], 'note');
    }

    /**
     * Get column value for 'paymentTransactionType' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getPaymentTransactionTypeColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['paymentTransaction'])
            ? ''
            : $this->getColumnValueByName($dataset['paymentTransaction'], 'type');
    }

    /**
     * Get column value for 'paymentTransactionId' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return string
     */
    protected function getPaymentTransactionIdColumnValue(array $dataset, $name, $i)
    {
        return empty($dataset['paymentTransaction'])
            ? ''
            : $this->getColumnValueByName($dataset['paymentTransaction'], 'public_id');
    }

    /**
     * Get column value for 'paymentTransactionData' column
     *
     * @param array   $dataset Dataset
     * @param string  $name    Column name
     * @param integer $i       Subcolumn index
     *
     * @return array
     */
    protected function getPaymentTransactionDataColumnValue(array $dataset, $name, $i)
    {
        $result = array();

        if (!empty($dataset['paymentTransaction'])) {
            foreach ($dataset['paymentTransaction']->getData() as $data) {
                $result[] = $data->getName() . ': ' . $data->getValue();
            }
        }

        return $result;
    }

    // }}}

}
