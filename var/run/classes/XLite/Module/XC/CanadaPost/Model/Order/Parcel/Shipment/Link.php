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

namespace XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment;

/**
 * Class represents a Canada Post parcel shipment links
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Base\Common")
 * @Table  (name="order_capost_parcel_shipment_links")
 */
class Link extends \XLite\Module\XC\CanadaPost\Model\Base\Link
{
    /**
     * Link's shipment (reference to the canada post parcel shipment model)
     *
     * @var \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment
     *
     * @ManyToOne  (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment", inversedBy="links")
     * @JoinColumn (name="shipmentId", referencedColumnName="id")
     */
    protected $shipment;

    /**
     * Relation to a storage entity
     *
     * @var \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link\Storage
     *
     * @OneToOne (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link\Storage", mappedBy="link", cascade={"all"}, fetch="EAGER")
     */
    protected $storage;

	// {{{ Service methods

    /**
     * Set shipment
     *
     * @param \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment $shipment Shipment object (OPTIONAL)
     *
     * @return void
     */
    public function setShipment(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment $shipment = null)
    {
        $this->shipment = $shipment;
    }

    /**
     * Set storage
     *
     * @param \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link\Storage $storage Storage object
     *
     * @return void
     */
    public function setStorage(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link\Storage $storage)
    {
        $storage->setLink($this);
        
        $this->storage = $storage;
    }

	// }}}
    
    /**
     * Get store class
     *
     * @return string
     */
    protected function getStorageClass()
    {
        return '\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link\Storage';
    }

    /**
     * Get filename for PDF documents
     *
     * @return string
     */
    public function getFileName()
    {
        return 's_' . $this->getShipment()->getShipmentId() . '_' . parent::getFileName();
    }   

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
     * Set rel
     *
     * @param string $rel
     * @return Link
     */
    public function setRel($rel)
    {
        $this->rel = $rel;
        return $this;
    }

    /**
     * Get rel
     *
     * @return string 
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * Set href
     *
     * @param string $href
     * @return Link
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * Get href
     *
     * @return string 
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Set idx
     *
     * @param integer $idx
     * @return Link
     */
    public function setIdx($idx)
    {
        $this->idx = $idx;
        return $this;
    }

    /**
     * Get idx
     *
     * @return integer 
     */
    public function getIdx()
    {
        return $this->idx;
    }

    /**
     * Set mediaType
     *
     * @param string $mediaType
     * @return Link
     */
    public function setMediaType($mediaType)
    {
        $this->mediaType = $mediaType;
        return $this;
    }

    /**
     * Get mediaType
     *
     * @return string 
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * Get shipment
     *
     * @return XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment 
     */
    public function getShipment()
    {
        return $this->shipment;
    }

    /**
     * Get storage
     *
     * @return XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link\Storage 
     */
    public function getStorage()
    {
        return $this->storage;
    }
}