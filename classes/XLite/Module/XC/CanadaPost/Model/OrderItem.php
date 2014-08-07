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

namespace XLite\Module\XC\CanadaPost\Model;

/**
 * Class represents an order item model
 */
abstract class OrderItem extends \XLite\Model\OrderItem implements \XLite\Base\IDecorator
{
    /**
     * Canada Post parcel items (reference to the Canada Post parcel item model)
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Item", mappedBy="orderItem", cascade={"all"})
     */
    protected $capostParcelItems;

    /**
     * Canada Post return items (reference to the Canada Post return item model)
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Module\XC\CanadaPost\Model\ProductsReturn\Item", mappedBy="orderItem", cascade={"all"})
     */
    protected $capostReturnItems;

    /**
     * Add a Canada Post parcel item 
     *
     * @param \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Item $newItem Parcel's item model
     *
     * @return void
     */
    public function addCapostParcelItem(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Item $newItem)
    {
        $newItem->setOrderItem($this);

        $this->addCapostParcelItems($newItem);
    }

    /**
     * Add a Canada Post return item
     *
     * @param \XLite\Module\XC\CanadaPost\Model\ProductsReturn\Item $newItem Retrun's item model
     *
     * @return void
     */
    public function addCapostReturnItem(\XLite\Module\XC\CanadaPost\Model\ProductsReturn\Item $newItem)
    {
        $newItem->setOrderItem($this);
        
        $this->addCapostReturnItems($newItem);
    }
}
