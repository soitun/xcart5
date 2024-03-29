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
 * Class represents a Canada Post tracking events
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Base\Common")
 * @Table  (name="order_capost_parcel_shipment_tracking_events")
 */
class SignificantEvent extends \XLite\Model\AEntity
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
     * @ManyToOne  (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking", inversedBy="significantEvents")
     * @JoinColumn (name="trackingId", referencedColumnName="id")
     */
    protected $trackingDetails;

    /**
     * Event identifier used to identify event types
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $identifier;
    
    /**
     * yyyy-mm-dd - date of a tracking event
     *
     * @var string
     *
     * @Column (type="fixedstring", length=10)
     */
    protected $date;

    /**
     * hh:mm:ss - time of a tracking event
     *
     * @var string
     *
     * @Column (type="fixedstring", length=8)
     */
    protected $time;

    /**
     * Time zone associated with an event. May not be populated for international tracking events
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $timeZone;

    /**
     * A brief description of the event
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $description;

    /**
     * If the event presented is a signature capture event, the text of this field will represent the name of the signature. 
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $signatoryName;
    
    /**
     * Site information provided by the parcel handler
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $site;

    /**
     * For domestic events, this contains the province that the event occurred in
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $province;

    /**
     * Contains the office-id where a parcel is being/was retained
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $retailLocationId;

    /**
     * Retail name of the location where a parcel is/was held
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $retailName;

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

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return SignificantEvent
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * Get identifier
     *
     * @return string 
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set date
     *
     * @param fixedstring $date
     * @return SignificantEvent
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return fixedstring 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param fixedstring $time
     * @return SignificantEvent
     */
    public function setTime($time)
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Get time
     *
     * @return fixedstring 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set timeZone
     *
     * @param string $timeZone
     * @return SignificantEvent
     */
    public function setTimeZone($timeZone)
    {
        $this->timeZone = $timeZone;
        return $this;
    }

    /**
     * Get timeZone
     *
     * @return string 
     */
    public function getTimeZone()
    {
        return $this->timeZone;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return SignificantEvent
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set signatoryName
     *
     * @param string $signatoryName
     * @return SignificantEvent
     */
    public function setSignatoryName($signatoryName)
    {
        $this->signatoryName = $signatoryName;
        return $this;
    }

    /**
     * Get signatoryName
     *
     * @return string 
     */
    public function getSignatoryName()
    {
        return $this->signatoryName;
    }

    /**
     * Set site
     *
     * @param string $site
     * @return SignificantEvent
     */
    public function setSite($site)
    {
        $this->site = $site;
        return $this;
    }

    /**
     * Get site
     *
     * @return string 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set province
     *
     * @param string $province
     * @return SignificantEvent
     */
    public function setProvince($province)
    {
        $this->province = $province;
        return $this;
    }

    /**
     * Get province
     *
     * @return string 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set retailLocationId
     *
     * @param string $retailLocationId
     * @return SignificantEvent
     */
    public function setRetailLocationId($retailLocationId)
    {
        $this->retailLocationId = $retailLocationId;
        return $this;
    }

    /**
     * Get retailLocationId
     *
     * @return string 
     */
    public function getRetailLocationId()
    {
        return $this->retailLocationId;
    }

    /**
     * Set retailName
     *
     * @param string $retailName
     * @return SignificantEvent
     */
    public function setRetailName($retailName)
    {
        $this->retailName = $retailName;
        return $this;
    }

    /**
     * Get retailName
     *
     * @return string 
     */
    public function getRetailName()
    {
        return $this->retailName;
    }

    /**
     * Get trackingDetails
     *
     * @return XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking 
     */
    public function getTrackingDetails()
    {
        return $this->trackingDetails;
    }
}