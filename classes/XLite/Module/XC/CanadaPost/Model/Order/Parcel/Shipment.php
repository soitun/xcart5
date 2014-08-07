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
 * Class represents a Canada Post parcel shipment info (return from "Create Shipment" and "Create Non-Contract Shipment" requests)
 *
 * @Entity
 * @Table  (name="order_capost_parcel_shipment")
 */
class Shipment extends \XLite\Model\AEntity
{
    /**
     * Shipment statuses
     */
    const STATUS_CREATED     = 'created';
    const STATUS_TRANSMITTED = 'transmitted';
    const STATUS_SUSPENDED   = 'suspended';
    
    /**
     * Shipment unique ID
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer")
     */
	protected $id;

    /**
     * Shipment's parcel (reference to the Canada Post parcels model)
     *
     * @var \XLite\Module\XC\CanadaPost\Model\Order\Parcel
     *
     * @OneToOne  (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel", inversedBy="shipment")
     * @JoinColumn (name="parcelId", referencedColumnName="id")
     */
    protected $parcel;

    /**
     * This structure represents a list of links to information relating to the shipment that was created (referece to the shipment's links model)
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link", mappedBy="shipment", cascade={"all"})
     */
    protected $links;

    /**
     * Manifests (for contracted shipments only)
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Manifest", mappedBy="shipments", cascade={"all"})
     */
    protected $manifests;

    /**
     * Tracking details (return from "Get Tracking Details" request)
     *
     * @var \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking
     *
     * @OneToOne (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking", mappedBy="shipment", cascade={"all"})
     */
    protected $trackingDetails;

    /**
     * A unique identifier for the shipment
     * This can be used in any future calls to Transmit Shipments to indicate that this shipment is to be excluded from the transmit.
     *
     * @var string 
     *
     * @Column (type="string", length=32, nullable=false)
     */
    protected $shipmentId;

    /**
     * Indicates the current status of the shipment
     *
     * @var string
     *
     * @Column (type="string", length=14, nullable=true)
     */
    protected $shipmentStatus;

    /**
     * This is the tracking PIN for the shipment
     * The tracking PIN can be used as input to other parcel web service calls such as Get Tracking Details.
     *
     * @var string
     *
     * @Column (type="string", length=16, nullable=true)
     */
    protected $trackingPin;

    /**
     * This is the tracking PIN for the return shipment. 
     * The tracking PIN can be used as input to other parcel web service calls such as Get Tracking Details.
     *
     * @var string
     *
     * @Column (type="string", length=16, nullable=true)
     */
    protected $returnTrackingPin;

    /**
     * The Canada Post Purchase Order number; only applicable and returned on a shipment where no manifest is required for proof of payment
     *
     * @var string
     *
     * @Column (type="string", length=32, nullable=true)
     */
    protected $poNumber;

    /**
     * Constructor
     *
     * @param array $data Entity properties (OPTIONAL)
     *
     * @return void
     */
    public function __construct(array $data = array())
    {
        $this->links = new \Doctrine\Common\Collections\ArrayCollection();
        $this->manifests = new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct($data);
    }

	// {{{ Service methods

    /**
     * Set shipment's parcel
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
     * Add a link to shipment
     *
     * @param \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link $newLink Link object
     *
     * @return void
     */
    public function addLink(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link $newLink)
    {
        $newLink->setShipment($this);

        $this->addLinks($newLink);
    }

    /**
     * Associate a manifest 
     *
     * @param \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Manifest $manifest Manifest object
     *
     * @return void
     */
    public function addManifest(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Manifest $manifest)
    {
        $manifest->addShipment($this);
        
        $this->manifests[] = $manifest;
    }
    
    /**
     * Set tracking details
     *
     * @param \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking $tracking Tracking details object
     *
     * @return void
     */
    public function setTrackingDetails(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking $tracking = null)
    {
        if (isset($tracking)) {
            $tracking->setShipment($this);
        }

        $this->trackingDetails = $tracking;
    }
    
    /** 
     * Get tracking details wrapper
     *
     * @return \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking|null
     */
    public function getTrackingDetails()
    {
        // Get actual tracking details
        $trackingPin = $this->getTrackingPin();

        if (
            !isset($this->trackingDetails)
            && !empty($trackingPin)
        ) {
            // Get tracking details from the Canada Post server
            $data = \XLite\Module\XC\CanadaPost\Core\Service\Tracking::getInstance()
                ->callGetTrackingDetailsByPinNumber($trackingPin);

            if (isset($data->trackingDetail)) {
                
                // Prepare tracking details
                $trackingDetail = $this->prepareTrackingData($data->trackingDetail);

                $details = new \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking($trackingDetail);

                $details->setShipment($this);
                $this->trackingDetails = $details;

                \XLite\Core\Database::getEM()->persist($details);

                $details->updateExpiry();

                if (isset($trackingDetail['_deliveryOptions'])) {

                    // Add delivery options
                    foreach ($trackingDetail['_deliveryOptions'] as $option_data) {
                        
                        $option = new \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking\DeliveryOption($option_data);

                        \XLite\Core\Database::getEM()->persist($option);

                        $details->addDeliveryOption($option);
                    }
                }
                
                if (isset($trackingDetail['_significantEvents'])) {
                    
                    // Add significant  events
                    foreach ($trackingDetail['_significantEvents'] as $event_data) {
                        
                        $event = new \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking\SignificantEvent($event_data);

                        \XLite\Core\Database::getEM()->persist($event);

                        $details->addSignificantEvent($event);
                    }
                }

                \XLite\Core\Database::getEM()->flush();
                
                // Download files if they are exists
                $details->downloadFiles();
            }
        }

        return $this->trackingDetails;
    }

	// }}}

    /**
     * Check - is shipment has manifests or not
     *
     * @return boolean
     */
    public function hasManifests()
    {
        return 0 < $this->getManifests()->count();
    }
    
    /**
     * Get link by rel field
     *
     * @param string $rel Link's rel field value
     *
     * @return \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link|null
     */
    public function getLinkByRel($rel)
    {
        $link = null;
        
        foreach ($this->getLinks() as $_link) {
            if ($_link->getRel() == $rel) {
                $link = $_link;
                break;
            }
        }   
        
        return $link;
    }

    /**
     * Get links only to PDF documents
     *
     * @return array|null
     */
    public function getPDFLinks()
    {
        $links = array();

        foreach ($this->getLinks() as $link) {
            if ('application/pdf' == $link->getMediaType()) {
                $links[] = $link;
            }
        }

        return (!empty($links)) ? $links : null;
    }
    
    /**
     * Prepare tracking data 
     *
     * @param \XLite\Core\CommonCell $data Tracking data 
     *
     * @return array
     */
    protected function prepareTrackingData($data)
    {
        $trackingDetail = array();

        // Prepare main tracking details
        foreach ($data as $field => $value) {

            if (!is_array($value)) {

                if ('activeExists' == $field || 'archiveExists' == $field) {

                    $value = (bool) $value;

                } else if ('signatureImageExists' == $field || 'suppressSignature' == $field) {

                     $value = ('true' == $value) ? true : false;
                }

                $trackingDetail[$field] = $value;
            }
        }
        
        // Prepare delivery options
        if (
            isset($data->deliveryOptions)
            && !empty($data->deliveryOptions)
        ) {
            $trackingDetail['_deliveryOptions'] = array();

            foreach ($data->deliveryOptions as $field => $value) {
                $trackingDetail['_deliveryOptions'][] = array(
                    'name'        => $field,
                    'description' => $value,
                );
            }
        }
        
        // Prepare significant events
        if (
            isset($data->significantEvents)
            && !empty($data->significantEvents)
        ) {
            $trackingDetail['_significantEvents'] = array();

            foreach ($data->significantEvents as $event) {

                $_event = array();

                foreach ($event as $field => $value) {

                    $_field = lcfirst(str_replace('event', '', $field));

                    $_event[$_field] = $value;
                }

                $trackingDetail['_significantEvents'][] = $_event;
            }
        }

        return $trackingDetail;
    }
}
