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

namespace XLite\Core;

/**
 * Order history main point of execution
 */
class OrderHistory extends \XLite\Base\Singleton
{
    /**
     * Codes for registered events of order history
     */
    const CODE_PLACE_ORDER                  = 'PLACE ORDER';
    const CODE_CHANGE_STATUS_ORDER          = 'CHANGE STATUS ORDER';
    const CODE_CHANGE_PAYMENT_STATUS_ORDER  = 'CHANGE PAYMENT STATUS ORDER';
    const CODE_CHANGE_SHIPPING_STATUS_ORDER = 'CHANGE SHIPPING STATUS ORDER';
    const CODE_CHANGE_NOTES_ORDER           = 'CHANGE NOTES ORDER';
    const CODE_CHANGE_AMOUNT                = 'CHANGE PRODUCT AMOUNT';
    const CODE_EMAIL_CUSTOMER_SENT          = 'EMAIL CUSTOMER SENT';
    const CODE_EMAIL_ADMIN_SENT             = 'EMAIL ADMIN SENT';
    const CODE_TRANSACTION                  = 'TRANSACTION';
    const CODE_ORDER_PACKAGING              = 'ORDER PACKAGING';
    const CODE_ORDER_TRACKING               = 'ORDER TRACKING';

    /**
     * Texts for the order history event descriptions
     */
    const TXT_PLACE_ORDER                   = 'Order placed';
    const TXT_CHANGE_STATUS_ORDER           = 'Order status changed from {{oldStatus}} to {{newStatus}}';
    const TXT_CHANGE_PAYMENT_STATUS_ORDER   = 'Order payment status changed from {{oldStatus}} to {{newStatus}}';
    const TXT_CHANGE_SHIPPING_STATUS_ORDER  = 'Order shipping status changed from {{oldStatus}} to {{newStatus}}';
    const TXT_CHANGE_NOTES_ORDER            = 'Order notes changed from "{{oldNote}}" to "{{newNote}}"';
    const TXT_CHANGE_AMOUNT_ADDED           = '[Inventory] Return back to stock: "{{product}}" product amount in stock changes from "{{oldInStock}}" to "{{newInStock}}" ({{qty}} items)';
    const TXT_CHANGE_AMOUNT_REMOVED         = '[Inventory] Removed from stock: "{{product}}" product amount in stock changes from "{{oldInStock}}" to "{{newInStock}}" ({{qty}} items)';
    const TXT_UNABLE_RESERVE_AMOUNT         = '[Inventory] Unable to reduce stock for product: "{{product}}", amount: "{{qty}}" items';
    const TXT_TRACKING_INFO_UPDATE          = '[Tracking] Tracking information was updated';
    const TXT_TRACKING_INFO_ADDED           = '"{{number}}" tracking number is added';
    const TXT_TRACKING_INFO_REMOVED         = '"{{number}}" tracking number is removed';
    const TXT_TRACKING_INFO_CHANGED         = 'Tracking number is changed from "{{old_number}}" to "{{new_number}}"';
    const TXT_EMAIL_CUSTOMER_SENT           = 'Email sent to the customer';
    const TXT_EMAIL_ADMIN_SENT              = 'Email sent to the admin';
    const TXT_TRANSACTION                   = 'Transaction made';
    const TXT_ORDER_PACKAGING               = 'Products have been split into parcels in order to estimate the shipping cost';

    /**
     * Register event to the order history. Main point of action.
     *
     * @param integer $orderId     Order identificator
     * @param string  $code        Event code
     * @param string  $description Event description
     * @param array   $data        Data for event description OPTIONAL
     * @param string  $comment     Event comment OPTIONAL
     * @param string  $details     Event details OPTIONAL
     *
     * @return void
     */
    public function registerEvent($orderId, $code, $description, array $data = array(), $comment = '', $details = array())
    {
        \XLite\Core\Database::getRepo('XLite\Model\OrderHistoryEvents')
            ->registerEvent($orderId, $code, $description, $data, $comment, $details);
    }

    /**
     * Register the change amount inventory
     *
     * @param integer              $orderId Order identificator
     * @param \XLite\Model\Product $product Product object
     * @param integer              $delta   Inventory delta changes
     *
     * @return void
     */
    public function registerChangeAmount($orderId, $product, $delta)
    {
        $inventory = $product->getInventory();
        if ($inventory->getEnabled()) {
            $this->registerEvent(
                $orderId,
                static::CODE_CHANGE_AMOUNT,
                $this->getOrderChangeAmountDescription($orderId, $delta, $inventory),
                $this->getOrderChangeAmountData($orderId, $product->getName(), $inventory->getAmount(), $delta)
            );
        }
    }

    /**
     * Register "Place order" event to the order history
     *
     * @param integer $orderId
     *
     * @return void
     */
    public function registerPlaceOrder($orderId)
    {
        $this->registerEvent(
            $orderId,
            static::CODE_PLACE_ORDER,
            $this->getPlaceOrderDescription($orderId),
            $this->getPlaceOrderData($orderId)
        );
    }

    /**
     * Register "Place order" event to the order history
     *
     * @param integer                              $orderId  Order ID
     * @param \XLite\Logic\Order\Modifier\Shipping $modifier Order's shipping modifier
     *
     * @return void
     */
    public function registerOrderPackaging($orderId, $modifier)
    {
        $packages = $modifier && $modifier->getMethod() && $modifier->getMethod()->getProcessorObject()
            ? $modifier->getMethod()->getProcessorObject()->getPackages($modifier)
            : array();

        if (is_array($packages) && 1 < count($packages)) {

            $result = array();

            // Correct package keys to improve appearance
            foreach ($packages as $packId => $pack) {
                $result[$packId+1] = $pack;
            }

            // Register event
            $this->registerEvent(
                $orderId,
                static::CODE_ORDER_PACKAGING,
                $this->getOrderPackagingDescription($orderId),
                array(),
                $this->getOrderPackagingComment($result)
            );
        }
    }

    /**
     * Register changes of order in the order history
     *
     * @param integer $orderId
     * @param array   $changes
     *
     * @return void
     */
    public function registerOrderChanges($orderId, $changes)
    {
        foreach ($changes as $name => $change) {
            if (method_exists($this, 'registerOrderChange' . ucfirst($name))) {
                $this->{'registerOrderChange' . ucfirst($name)}($orderId, $change);
            }
        }
    }

    /**
     * Register status order changes
     *
     * @param integer $orderId
     * @param array   $change  old,new structure
     *
     * @return void
     */
    public function registerOrderChangeStatus($orderId, $change)
    {
        $this->registerEvent(
            $orderId,
            $this->getOrderChangeStatusCode($orderId, $change),
            $this->getOrderChangeStatusDescription($orderId, $change),
            $this->getOrderChangeStatusData($orderId, $change)
        );
    }

    /**
     * Register order notes changes
     *
     * @param integer $orderId
     * @param array   $change  old,new structure
     *
     * @return void
     */
    public function registerOrderChangeAdminNotes($orderId, $change)
    {
        $this->registerEvent(
            $orderId,
            static::CODE_CHANGE_NOTES_ORDER,
            $this->getOrderChangeNotesDescription($orderId, $change),
            $this->getOrderChangeNotesData($orderId, $change)
        );
    }

    /**
     * Register email sending to the customer
     *
     * @param integer $orderId
     * @param string  $comment OPTIONAL
     *
     * @return void
     */
    public function registerCustomerEmailSent($orderId, $comment = '')
    {
        $this->registerEvent(
            $orderId,
            static::CODE_EMAIL_CUSTOMER_SENT,
            $this->getCustomerEmailSentDescription($orderId),
            $this->getCustomerEmailSentData($orderId),
            $comment
        );
    }

    /**
     * Register any changes on the tracking information update (chnaged, )
     *
     * @param integer $orderId
     * @param array   $added
     * @param array   $removed
     * @param array   $changed
     *
     * @return void
     */
    public function registerTrackingInfoUpdate($orderId, $added, $removed, $changed)
    {
        $this->registerEvent(
            $orderId,
            static::CODE_ORDER_TRACKING,
            $this->getTrackingInfoDescription($orderId),
            $this->getTrackingInfoData($orderId),
            $this->getTrackingInfoComment($added, $removed, $changed)
        );
    }

    /**
     * Defines the text for the tracking information update
     *
     * @param integer $orderId
     *
     * @return string
     */
    protected function getTrackingInfoDescription($orderId)
    {
        return static::TXT_TRACKING_INFO_UPDATE;
    }

    /**
     * No tracking information specific data is defined
     *
     * @param integer $orderId
     *
     * @return array
     */
    protected function getTrackingInfoData($orderId)
    {
        return array();
    }

    /**
     * Defines the comment for the tracking information update
     *
     * @param array $added
     * @param array $removed
     * @param array $changed
     *
     * @return string
     */
    protected function getTrackingInfoComment($added, $removed, $changed)
    {
        $comment = '';

        foreach ($added as $value) {
            $comment .= static::t(static::TXT_TRACKING_INFO_ADDED, array('number' => $value)) . '<br />';
        }

        foreach ($removed as $value) {
            $comment .= static::t(static::TXT_TRACKING_INFO_REMOVED, array('number' => $value)) . '<br />';
        }

        foreach ($changed as $value) {
            $comment .= static::t(static::TXT_TRACKING_INFO_CHANGED, array('old_number' => $value['old'], 'new_number' => $value['new'])) . '<br />';
        }

        return $comment;
    }

    /**
     * Register email sending to the admin in the order history
     *
     * @param integer $orderId
     * @param string  $comment OPTIONAL
     *
     * @return void
     */
    public function registerAdminEmailSent($orderId, $comment = '')
    {
        $this->registerEvent(
            $orderId,
            static::CODE_EMAIL_ADMIN_SENT,
            $this->getAdminEmailSentDescription($orderId),
            $this->getAdminEmailSentData($orderId),
            $comment
        );
    }

    /**
     * Register transaction data to the order history
     *
     * @param integer $orderId
     * @param string  $transactionData
     *
     * @return void
     */
    public function registerTransaction($orderId, $description, $details = array(), $comment = '')
    {
        $this->registerEvent(
            $orderId,
            static::CODE_TRANSACTION,
            $description,
            array(),
            $comment,
            $details
        );
    }

    /**
     * Text for place order description
     *
     * @param integer $orderId
     *
     * @return string
     */
    protected function getPlaceOrderDescription($orderId)
    {
        return static::TXT_PLACE_ORDER;
    }

    /**
     * Data for place order description
     *
     * @param integer $orderId
     *
     * @return array
     */
    protected function getPlaceOrderData($orderId)
    {
        return array(
            'orderId' => $orderId,
        );
    }

    /**
     * Text for place order description
     *
     * @param integer $orderId
     *
     * @return string
     */
    protected function getOrderPackagingDescription($orderId)
    {
        return static::TXT_ORDER_PACKAGING;
    }

    /**
     * Data for place order description
     *
     * @param array $packages
     *
     * @return array
     */
    protected function getOrderPackagingComment($packages)
    {
        // Switch interface to admin
        $layout = \XLite\Core\Layout::getInstance();
        $old_skin = $layout->getSkin();
        $old_interface = $layout->getInterface();
        $layout->setAdminSkin();

        // Get compiled widget content
        $widget = new \XLite\View\Order\Details\Admin\Packaging(
            array(
                \XLite\View\Order\Details\Admin\Packaging::PARAM_PACKAGES => $packages,
            )
        );

        $result = $widget->getContent();

        // Restore interface
        switch ($old_interface) {

            case \XLite::ADMIN_INTERFACE:
                $layout->setAdminSkin();
                break;

            case \XLite::CUSTOMER_INTERFACE:
                $layout->setCustomerSkin();
                break;

            case \XLite::CONSOLE_INTERFACE:
                $layout->setConsoleSkin();
                break;

            case \XLite::MAIL_INTERFACE:
                $layout->setMainSkin();
                break;
        }

        $layout->setSkin($old_skin);

        return $result;
    }


    /**
     * Text for change order status description
     *
     * @param integer $orderId
     * @param array   $change
     *
     * @return string
     */
    protected function getOrderChangeStatusCode($orderId, array $change)
    {
        return isset($change['type']) && $change['type']
            ? (
                'payment' == $change['type']
                ? static::CODE_CHANGE_PAYMENT_STATUS_ORDER
                : static::CODE_CHANGE_SHIPPING_STATUS_ORDER
            ) : static::CODE_CHANGE_STATUS_ORDER;
    }

    /**
     * Text for change order status description
     *
     * @param integer $orderId
     * @param array   $change
     *
     * @return string
     */
    protected function getOrderChangeStatusDescription($orderId, array $change)
    {
        return isset($change['type']) && $change['type']
            ? (
                'payment' == $change['type']
                ? static::TXT_CHANGE_PAYMENT_STATUS_ORDER
                : static::TXT_CHANGE_SHIPPING_STATUS_ORDER
            ) : static::TXT_CHANGE_STATUS_ORDER;
    }

    /**
     * Data for change order status description
     *
     * @param integer $orderId
     * @param array   $change
     *
     * @return array
     */
    protected function getOrderChangeStatusData($orderId, array $change)
    {
        return array(
            'orderId'   => $orderId,
            'newStatus' => $change['new']->getName(),
            'oldStatus' => $change['old']->getName(),
        );
    }

    /**
     * Text for change amount
     *
     * @param integer $orderId
     * @param integer $delta
     *
     * @return string
     */
    protected function getOrderChangeAmountDescription($orderId, $delta, \XLite\Model\Inventory $inventory)
    {
        return $delta < 0
            ? ($this->isAbleToReduceAmount($inventory, $delta) ? static::TXT_CHANGE_AMOUNT_REMOVED : static::TXT_UNABLE_RESERVE_AMOUNT)
            : static::TXT_CHANGE_AMOUNT_ADDED;
    }

    /**
     * Data for change amount description
     *
     * @param integer $orderId
     * @param string  $productName
     * @param integer $oldAmount
     * @param integer $delta
     *
     * @return array
     */
    protected function getOrderChangeAmountData($orderId, $productName, $oldAmount, $delta)
    {
        return array(
            'orderId'    => $orderId,
            'newInStock' => $oldAmount + $delta,
            'oldInStock' => $oldAmount,
            'product'    => $productName,
            'qty'        => abs($delta),
        );
    }

    /**
     * Text for change order notes description
     *
     * @param integer $orderId
     * @param array   $change
     *
     * @return string
     */
    protected function getOrderChangeNotesDescription($orderId, $change)
    {
        return static::TXT_CHANGE_NOTES_ORDER;
    }

    /**
     * Data for change order notes description
     *
     * @param integer $orderId
     * @param array   $change
     *
     * @return array
     */
    protected function getOrderChangeNotesData($orderId, $change)
    {
        return array(
            'orderId' => $orderId,
            'newNote' => $change['new'],
            'oldNote' => $change['old'],
        );
    }

    /**
     * Text for customer email sent description
     *
     * @param integer $orderId
     *
     * @return string
     */
    protected function getCustomerEmailSentDescription($orderId)
    {
        return static::TXT_EMAIL_CUSTOMER_SENT;
    }

    /**
     * Data for customer email sent description
     *
     * @param integer $orderId
     *
     * @return array
     */
    protected function getCustomerEmailSentData($orderId)
    {
        return array(
            'orderId' => $orderId,
        );
    }

    /**
     * Text for admin email sent description
     *
     * @param integer $orderId
     *
     * @return string
     */
    protected function getAdminEmailSentDescription($orderId)
    {
        return static::TXT_EMAIL_ADMIN_SENT;
    }

    /**
     * Data for admin email sent description
     *
     * @param integer $orderId
     *
     * @return array
     */
    protected function getAdminEmailSentData($orderId)
    {
        return array(
            'orderId' => $orderId,
        );
    }

    /**
     * Check if we need to register the record concerning the product inventory change
     *
     * @param \XLite\Model\Inventory $inventory
     * @param integer $delta
     *
     * @return boolean
     */
    protected function isAbleToReduceAmount(\XLite\Model\Inventory $inventory, $delta)
    {
        // Do record if the product is reserved and we have enough amount in stock for it
        return $inventory->getAmount() > abs($delta);
    }
}
