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

namespace XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking;

/**
 * Class represents a Canada Post tracking delivery options
 *
 * @Entity
 * @Table  (name="order_capost_parcel_shipment_tracking_options")
 */
class DeliveryOption extends \XLite\Model\AEntity
{
    /**
     * Unique ID
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer")
     */
    protected $id;

    /**
     * Shipment tracking details (reference to the Canada Post tracking model)
     *
     * @var \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking
     *
     * @ManyToOne  (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking", inversedBy="deliveryOptions")
     * @JoinColumn (name="trackingId", referencedColumnName="id")
     */
    protected $trackingDetails;

    /**
     * The string representing the delivery-option
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $name;
    
    /**
     * The description of the delivery option
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $description;


	// {{{ Service methods

    /**
     * Set tracking details
     *
     * @param \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking $tracking Tracking object (OPTIONAL)
     *
     * @return void
     */
    public function setTrackingDetails(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking $tracking = null)
    {
        $this->trackingDetails = $tracking;
    }

	// }}}
}
