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

namespace XLite\Module\XC\CanadaPost\Controller\Customer;

/**
 * Canada Post create return request
 */
class CapostReturns extends \XLite\Controller\Customer\ACustomer
{
    /**
     * Controller parameters
     *
     * @var array
     */
    protected $params = array('target', 'order_number', 'order_id');

    /**
     * Order (cache)
     *
     * @var \XLite\Model\Order|null
     */
    protected $order;

    /**
     * Return the current page title (for the content area)
     *
     * @return string
     */
    public function getTitle()
    {
        return 'Return products';
    }

    /**
     * Common method to determine current location
     *
     * @return string
     */
    protected function getLocation()
    {
        return $this->getTitle();
    }

    /**
     * Add part to the location nodes list
     *
     * @return void
     */
    protected function addBaseLocation()
    {
        parent::addBaseLocation();

        $this->addLocationNode('Search for orders', $this->buildURL('order_list'));

        $this->addLocationNode(
            'Order details', 
            $this->buildURL('order', '', array('order_number' => $this->getOrder()->getOrderNumber()))
        );
    }

    /**
     * Get current order ID
     *
     * @return integer|null
     */
    protected function getOrderId()
    {
        return (isset(\XLite\Core\Request::getInstance()->order_id)) 
            ? intval(\XLite\Core\Request::getInstance()->order_id)
            : null;
    }
    
    /**
     * Get current ordernumber
     *
     * @return string|null
     */
    protected function getOrderNumber()
    {
        return (isset(\XLite\Core\Request::getInstance()->order_number))
            ? strval(\XLite\Core\Request::getInstance()->order_number)
            : null;
    }

    /**
     * Return current order
     *
     * @return \XLite\Model\Order|null
     */
    public function getOrder()
    {
        if (!isset($this->order)) {

            if ($this->getOrderId()) {

                $this->order = \XLite\Core\Database::getRepo('XLite\Model\Order')
                    ->find($this->getOrderId());

            } else if ($this->getOrderNumber()) {

                $this->order = \XLite\Core\Database::getRepo('XLite\Model\Order')
                    ->findOneByOrderNumber($this->getOrderNumber());
            }
        }

        return $this->order;
    }

    // {{{ Actions

    /**
     * Do action :: create return 
     * 
     * @return void
     */
    protected function doActionCreateReturn()
    {
        $items = $this->prepareReturnItems();
        
        $message = strval(\XLite\Core\Request::getInstance()); $this->getReturnMessage();

        if (!empty($items)) {

            $order = $this->getOrder();
            
            // Create new return model
            $returnRequest = new \XLite\Module\XC\CanadaPost\Model\ProductsReturn();

            \XLite\Core\Database::getEM()->persist($returnRequest);

            $returnRequest->setNotes($this->getReturnMessage());

            foreach ($items as $itemId => $itemData) {
                
                // Create new return item model
                $returnItem = new \XLite\Module\XC\CanadaPost\Model\ProductsReturn\Item();

                \XLite\Core\Database::getEM()->persist($returnItem);
                
                $returnItem->setAmount($itemData['amount']);
                $returnItem->setOrderItem($order->getItemById($itemId));
                
                $returnRequest->addItem($returnItem);
            }

            $order->addCapostReturn($returnRequest);

            \XLite\Core\Database::getEM()->flush();
            
            \XLite\Core\TopMessage::addInfo('The products return has been registered.');

        } else {

            \XLite\Core\TopMessage::addWarning('No items have been selected for return.');

        }
    }

    // }}}

    /**
     * Get return message
     *
     * @retrun string
     */
    protected function getReturnMessage()
    {
        return strval(\XLite\Core\Request::getInstance()->message ?: '');
    }

    /**
     * Get return items list
     *
     * @return array
     */
    protected function getReturnItems()
    {
        return (is_array(\XLite\Core\Request::getInstance()->items)) 
            ? \XLite\Core\Request::getInstance()->items 
            : array();
    }

    /**
     * Prepare return items data
     *
     * @return array
     */
    protected function prepareReturnItems()
    {
        $items = $this->getReturnItems();

        $result = array();

        if (
            !empty($items) 
            && is_array($items)
        ) {
            foreach ($items as $itemId => $itemData) {
                
                $itemId = intval($itemId);
                $itemData['amount'] = intval($itemData['amount']);
                
                if (
                    0 < $itemData['amount'] 
                    && $this->getOrder()->getItemById($itemId)
                ) {
                    $result[$itemId] = array(
                        'amount' => $itemData['amount'],
                    );
                }
            }
        }

        return $result;
    }
    
    // {{{ Access methods

    /**
     * Check if current page is accessible
     *
     * @return boolean
     */
    protected function checkAccess()
    {
        return (
            parent::checkAccess() 
            && $this->getOrder() 
            && $this->checkOrderAccess()
            && $this->getOrder()->isCapostShippingMethod()
        );
    }

    /**
     * Check if order corresponds to current user
     *
     * @return boolean
     */
    protected function checkOrderProfile()
    {
        return \XLite\Core\Auth::getInstance()->getProfile()->getProfileId()
            == $this->getOrder()->getOrigProfile()->getProfileId();
    }

    /**
     * Check order access
     *
     * @return boolean
     */
    protected function checkOrderAccess()
    {
        return (
            \XLite\Core\Auth::getInstance()->isLogged() 
            && (
                \XLite\Core\Auth::getInstance()->isAdmin()
                || $this->checkOrderProfile()
            )
        );
    }
   
    // }}}
}
