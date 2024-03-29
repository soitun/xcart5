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

namespace XLite\Model;

/**
 * @HasLifecycleCallbacks
 * @MappedSuperClass (repositoryClass="\XLite\Model\Repo\Base\Common")
 */
abstract class InventoryAbstract extends \XLite\Model\AEntity
{
    /**
     * Default amounts
     */
    const AMOUNT_DEFAULT_INV_TRACK = 1000;
    const AMOUNT_DEFAULT_LOW_LIMIT = 10;

    /**
     * Inventory unique ID
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="uinteger")
     */
    protected $inventoryId;

    /**
     * Is inventory tracking enabled or not
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $enabled = true;

    /**
     * Amount
     *
     * @var integer
     *
     * @Column (type="uinteger")
     */
    protected $amount = self::AMOUNT_DEFAULT_INV_TRACK;

    /**
     * Is low limit notification enabled or not
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $lowLimitEnabled = false;

    /**
     * Low limit amount
     *
     * @var integer
     *
     * @Column (type="uinteger")
     */
    protected $lowLimitAmount = self::AMOUNT_DEFAULT_LOW_LIMIT;

    /**
     * Product (association)
     *
     * @var \XLite\Model\Product
     *
     * @OneToOne   (targetEntity="XLite\Model\Product", inversedBy="inventory")
     * @JoinColumn (name="id", referencedColumnName="product_id")
     */
    protected $product;

    /**
     * Setter
     *
     * @param integer $amount Amount to set
     *
     * @return void
     */
    public function setAmount($amount)
    {
        $this->amount = $this->correctAmount($amount);
    }

    /**
     * Setter
     *
     * @param integer $amount Amount to set
     *
     * @return void
     */
    public function setLowLimitAmount($amount)
    {
        $this->lowLimitAmount = $this->correctAmount($amount);
    }

    /**
     * Increase / decrease product inventory amount
     *
     * @param integer $delta Amount delta
     *
     * @return void
     */
    public function changeAmount($delta)
    {
        if ($this->getEnabled()) {
            $this->setAmount($this->getAmount() + $delta);
        }
    }

    /**
     * Return product amount available to add to cart
     *
     * @return integer
     */
    public function getAvailableAmount()
    {
        return $this->getEnabled() ? $this->getAmount() - $this->getLockedAmount() : $this->getDefaultAmount();
    }

    /**
     * Get low available amount
     *
     * @return integer
     */
    public function getLowAvailableAmount()
    {
        return $this->getEnabled()
            ? min($this->getLowDefaultAmount(), $this->getAmount() - $this->getLockedAmount())
            : $this->getLowDefaultAmount();
    }

    /**
     * Alias: is product in stock or not
     *
     * @return boolean
     */
    public function isOutOfStock()
    {
        return $this->getEnabled() ? 0 >= $this->getAvailableAmount() : false;
    }

    /**
     * Check if product amount is less than its low limit
     *
     * @return boolean
     */
    public function isLowLimitReached()
    {
        return $this->getEnabled() && $this->getLowLimitEnabled() && $this->getAmount() < $this->getLowLimitAmount();
    }

    /**
     * Perform some actions before inventory saved
     *
     * @return void
     *
     * @PreUpdate
     */
    public function proccessPreUpdate()
    {
        if ($this->isLowLimitReached()) {
            $this->sendLowLimitNotification();
        }
    }


    /**
     * Check and (if needed) correct amount value
     *
     * @param integer $amount Value to check
     *
     * @return integer
     */
    protected function correctAmount($amount)
    {
        return max(0, intval($amount));
    }

    /**
     * Get list of cart items containing current product
     *
     * @return array
     */
    protected function getLockedItems()
    {
        return $this->getProduct()
            ? \XLite\Model\Cart::getInstance()->getItemsByProductId($this->getProduct()->getProductId())
            : array();
    }

    /**
     * Return "locked" amount: items already added to the cart
     *
     * @return integer
     */
    protected function getLockedAmount()
    {
        return \Includes\Utils\ArrayManager::sumObjectsArrayFieldValues($this->getLockedItems(), 'getAmount', true);
    }

    /**
     * Get a low default amount
     *
     * @return integer
     */
    protected function getLowDefaultAmount()
    {
        return 1;
    }

    /**
     * Default qty value to show to customers
     *
     * @return integer
     */
    protected function getDefaultAmount()
    {
        return self::AMOUNT_DEFAULT_INV_TRACK;
    }

    /**
     * Send notification to admin about product low limit
     *
     * @return void
     */
    protected function sendLowLimitNotification()
    {
        // TODO: add code after the Mailer will be refactored
    }

    /**
     * Get inventoryId
     *
     * @return uinteger 
     */
    public function getInventoryId()
    {
        return $this->inventoryId;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Inventory
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Get amount
     *
     * @return uinteger 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set lowLimitEnabled
     *
     * @param boolean $lowLimitEnabled
     * @return Inventory
     */
    public function setLowLimitEnabled($lowLimitEnabled)
    {
        $this->lowLimitEnabled = $lowLimitEnabled;
        return $this;
    }

    /**
     * Get lowLimitEnabled
     *
     * @return boolean 
     */
    public function getLowLimitEnabled()
    {
        return $this->lowLimitEnabled;
    }

    /**
     * Get lowLimitAmount
     *
     * @return uinteger 
     */
    public function getLowLimitAmount()
    {
        return $this->lowLimitAmount;
    }

    /**
     * Set product
     *
     * @param XLite\Model\Product $product
     * @return Inventory
     */
    public function setProduct(\XLite\Model\Product $product = null)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get product
     *
     * @return XLite\Model\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}