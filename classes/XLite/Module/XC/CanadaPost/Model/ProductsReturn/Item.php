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

namespace XLite\Module\XC\CanadaPost\Model\ProductsReturn;

/**
 * Class represents an return items model
 *
 * @Entity (repositoryClass="XLite\Module\XC\CanadaPost\Model\Repo\ProductsReturn\Item")
 * @Table  (name="capost_return_items")
 */
class Item extends \XLite\Model\AEntity
{
    /**
     * Item unique ID
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer")
     */
    protected $id;

    /**
     * Reference to the return model
     *
     * @var \XLite\Module\XC\CanadaPost\Model\ProductsReturn
     *
     * @ManyToOne  (targetEntity="XLite\Module\XC\CanadaPost\Model\ProductsReturn", inversedBy="items")
     * @JoinColumn (name="returnId", referencedColumnName="id")
     */
    protected $return;

    /**
     * Reference to the order item model
     *
     * @var \XLite\Model\OrderItem 
     *
     * @ManyToOne  (targetEntity="XLite\Model\OrderItem", inversedBy="capostReturnItems")
     * @JoinColumn (name="orderItemId", referencedColumnName="item_id")
     */
    protected $orderItem;

    /**
     * Item quantity
     *
     * @var integer
     *
     * @Column (type="uinteger")
     */
    protected $amount = 0;

    // {{{ Service methods

    /**
     * Assign the return
     *
     * @param \XLite\Module\XC\CanadaPost\Model\ProductsReturn $return Products return (OPTIONAL)
     *
     * @return void
     */
    public function setReturn(\XLite\Module\XC\CanadaPost\Model\ProductsReturn $return = null)
    {
        $this->return = $return;
    }

    /**
     * Assign the order item
     *
     * @param \XLite\Model\OrderItem $orderItem Order's item (OPTIONAL)
     *
     * @return void
     */
    public function setOrderItem(\XLite\Model\OrderItem $orderItem = null)
    {
        $this->orderItem = $orderItem;
    }

    // }}}
}
