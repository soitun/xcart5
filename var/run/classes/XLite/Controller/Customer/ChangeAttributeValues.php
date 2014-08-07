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

namespace XLite\Controller\Customer;

/**
 * Change attribute values from cart / wishlist item
 */
class ChangeAttributeValues extends \XLite\Controller\Customer\ACustomer
{
    /**
     * Item (cache)
     *
     * @var \XLite\Model\OrderItem
     */
    protected $item = null;

    /**
     * Get page title
     *
     * @return string
     */
    public function getTitle()
    {
        return static::t('"{{product}} product" attributes', array('product' => $this->getItem()->getName()));
    }

    /**
     * Initialize controller
     *
     * @return void
     */
    public function init()
    {
        parent::init();

        if (!$this->getItem()) {
            $this->redirect();
        }
    }

    /**
     * Get cart / wishlist item
     *
     * @return \XLite\Model\OrderItem
     */
    public function getItem()
    {
        if (!isset($this->item)) {
            $this->item = false;

            if (
                \XLite\Core\Request::getInstance()->source == 'cart'
                && is_numeric(\XLite\Core\Request::getInstance()->item_id)
            ) {
                $item = $this->getCart()->getItemByItemId(\XLite\Core\Request::getInstance()->item_id);

                if (
                    $item
                    && $item->getProduct()
                    && $item->hasAttributeValues()
                ) {
                    $this->item = $item;
                }
            }
        }

        return $this->item;
    }

    /**
     * Get product
     *
     * @return \XLite\Model\Product
     */
    public function getProduct()
    {
        return $this->getItem()->getProduct();
    }

    /**
     * Return selected attribute values ids
     *
     * @return array
     */
    public function getSelectedAttributeValuesIds()
    {
        return $this->getItem()->getAttributeValuesPlain();
    }

    /**
     * Common method to determine current location
     *
     * @return array
     */
    protected function getLocation()
    {
        return $this->getTitle();
    }

    /**
     * Perform some actions before redirect
     *
     * FIXME: check. Action should not be an optional param
     *
     * @param string $action Current action OPTIONAL
     *
     * @return void
     */
    protected function actionPostprocess($action = null)
    {
        parent::actionPostprocess($action);

        if ($action) {
            $this->assembleReturnURL();
        }
    }

    /**
     * Assemble return url
     *
     * @return void
     */
    protected function assembleReturnURL()
    {
        $this->setReturnURL($this->buildURL(\XLite::TARGET_DEFAULT));

        if ($this->internalError) {
            $this->setReturnURL(
                $this->buildURL(
                    'change_attribute_values',
                    '',
                    array(
                        'source' => \XLite\Core\Request::getInstance()->source,
                        'storage_id' => \XLite\Core\Request::getInstance()->storage_id,
                        'item_id' => \XLite\Core\Request::getInstance()->item_id,
                    )
                )
            );

        } elseif (\XLite\Core\Request::getInstance()->source == 'cart') {
            $this->setReturnURL($this->buildURL('cart'));
        }
    }

    /**
     * Change product attribute values
     *
     * @param array $attributeValues Attrbiute values (prepared, from request)
     *
     * @return boolean 
     */
    protected function saveAttributeValues(array $attributeValues)
    {
        $this->getItem()->setAttributeValues($attributeValues);

        return true;
    }

    /**
     * Change product attribute values
     *
     * @return void
     */
    protected function doActionChange()
    {
        if ('cart' == \XLite\Core\Request::getInstance()->source) {
            $attributeValues = $this->getProduct()->prepareAttributeValues(
                \XLite\Core\Request::getInstance()->attribute_values
            );
            if ($this->saveAttributeValues($attributeValues)) {
                $this->updateCart();

                \XLite\Core\Database::getEM()->flush();
                \XLite\Core\TopMessage::addInfo('Attributes have been successfully changed');

                $this->checkItemsAmount();

                $this->setSilenceClose();

            }  else {

                $message = $this->getErrorMessage();

                \XLite\Core\TopMessage::addError($message);

                \XLite\Core\Session::getInstance()->error_message = static::t($message);

                $this->setInternalRedirect();
                $this->internalError = true;
            }
        }
    }

    /**
     * Get error message
     *
     * @return string
     */
    protected function getErrorMessage()
    {
        return 'Please select other attribute';
    }

    /**
     * Check amount for all cart items
     *
     * @return void
     */
    protected function checkItemsAmount()
    {
        foreach ($this->getCart()->getItemsWithWrongAmounts() as $item) {
            $this->processInvalidAmountError($item);
        }
    }

    /**
     * Show message about wrong product amount
     *
     * @param \XLite\Model\OrderItem $item Order item
     *
     * @return void
     */
    protected function processInvalidAmountError(\XLite\Model\OrderItem $item)
    {
        \XLite\Core\TopMessage::addWarning(
            'You tried to buy more items of "{{product}}" product {{description}} than are in stock. We have {{amount}} item(s) only. Please adjust the product quantity.',
            array(
                'product'     => $item->getProduct()->getName(),
                'description' => $item->getExtendedDescription(),
                'amount'      => $item->getProductAvailableAmount()
            )
        );
    }
}
