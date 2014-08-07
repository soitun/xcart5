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

namespace XLite\Model\OrderItem;

/**
 * Surcharge
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\OrderItem\Surcharge")
 * @Table  (name="order_item_surcharges")
 */
class Surcharge extends \XLite\Model\Base\Surcharge
{
    /**
     * Surcharge owner (order item)
     *
     * @var \XLite\Model\OrderItem
     *
     * @ManyToOne  (targetEntity="XLite\Model\OrderItem", inversedBy="surcharges")
     * @JoinColumn (name="item_id", referencedColumnName="item_id")
     */
    protected $owner;

    /**
     * Get order
     *
     * @return void
     */
    public function getOrder()
    {
        return $this->getOwner()->getOrder();
    }

    /**
     * Get id
     *
     * @return uinteger 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param fixedstring $type
     * @return Surcharge
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return fixedstring 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Surcharge
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set class
     *
     * @param string $class
     * @return Surcharge
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set include
     *
     * @param boolean $include
     * @return Surcharge
     */
    public function setInclude($include)
    {
        $this->include = $include;
        return $this;
    }

    /**
     * Get include
     *
     * @return boolean 
     */
    public function getInclude()
    {
        return $this->include;
    }

    /**
     * Set available
     *
     * @param boolean $available
     * @return Surcharge
     */
    public function setAvailable($available)
    {
        $this->available = $available;
        return $this;
    }

    /**
     * Get available
     *
     * @return boolean 
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * Get value
     *
     * @return decimal 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Surcharge
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get owner
     *
     * @return XLite\Model\OrderItem 
     */
    public function getOwner()
    {
        return $this->owner;
    }
}