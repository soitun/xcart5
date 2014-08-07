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

namespace XLite\Module\XC\CanadaPost\Model\Order\Parcel;

/**
 * Class represents a Canada Post parcel items
 *
 * @Entity (repositoryClass="XLite\Module\XC\CanadaPost\Model\Repo\Order\Parcel\Item")
 * @Table  (name="order_capost_parcel_items")
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
     * Item's parcel (reference to the canada post parcels model)
     *
     * @var \XLite\Module\XC\CanadaPost\Model\Order\Parcel
     *
     * @ManyToOne  (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel", inversedBy="items")
     * @JoinColumn (name="parcelId", referencedColumnName="id")
     */
    protected $parcel;

	/**
	 * Item's order item (reference to the order items model)
	 *
	 * @var \XLite\Model\OrderItem 
	 *
	 * @ManyToOne  (targetEntity="XLite\Model\OrderItem", inversedBy="capostParcelItems")
	 * @JoinColumn (name="orderItemId", referencedColumnName="item_id")
	 */
	protected $orderItem;

    /**
     * Item quantity
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $amount = 0;

	// {{{ Service methods

    /**
     * Assign the parcel
     *
     * @param \XLite\Module\XC\CanadaPost\Model\Order\Parcel $parcel Order's parcel (OPTIONAL)
     *
     * @return void
     */
    public function setParcel(\XLite\Module\XC\CanadaPost\Model\Order\Parcel $parcel = null)
    {
        $this->parcel = $parcel;
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

    /**
     * Get single item weight (in store weight units)
     *
     * @return float
     */
    public function getWeight()
    {
        $object = $this->getOrderItem()->getObject();
        $result = ($object) ? $object->getWeight() : 0;

        foreach ($this->getOrderItem()->getAttributeValues() as $attributeValue) {
            if ($attributeValue->getAttributeValue()) {
                $result += $attributeValue->getAttributeValue()->getAbsoluteValue('weight');
            }
        }

        return $result;
    }

    /**
     * Get single item weight in KG
     *
     * @param boolean $adjustFloatValue Flag - adjust float value or not (OPTIONAL)
     *
     * @return float
     */
    public function getWeightInKg($adjustFloatValue = false)
    {
        // Convert weight from store units to KG (weight must be in KG)
        $weight = \XLite\Core\Converter::convertWeightUnits(
            $this->getWeight(),
            \XLite\Core\Config::getInstance()->Units->weight_unit,
            'kg'
        );

        if ($adjustFloatValue) {
            // Adjust according to the XML element schema
            $weight = \XLite\Module\XC\CanadaPost\Core\Service\AService::adjustFloatValue($weight, 3, 0, 99.999);
        }

        return $weight;
    }

    /**
	 * Get total item weight (in store weight units)
	 *
	 * @return float
	 */
	public function getTotalWeight()
	{
		return $this->getWeight() * $this->getAmount();
	}

    /**
     * Get total item weight in KG
     *
     * @param boolean $adjustFloatValue Flag - adjust float value or not (OPTIONAL)
     *
     * @return float
     */
    public function getTotalWeightInKg($adjustFloatValue = false)
    {
        return $this->getWeightInKg($adjustFloatValue) * $this->getAmount();
    }
}
