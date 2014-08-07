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
 * Class represents a Canada Post tracking files 
 *
 * @Entity (repositoryClass="\XLite\Module\XC\CanadaPost\Model\Repo\Order\Parcel\Shipment\Tracking\File")
 * @Table  (name="order_capost_parcel_shipment_tracking_files")
 */
class File extends \XLite\Model\Base\Storage
{
    /**
     * Document type
     */
    const DOCTYPE_SIGN_IMAGE = 'I';
    const DOCTYPE_DCONG_CERT = 'C';

    /**
     * Tracking document type
     *
     * @param string
     *
     * @Column (type="fixedstring", length=1)
     */
    protected $docType = self::DOCTYPE_SIGN_IMAGE;

    /**
     * Relation to a Canada Post tracking entity
     *
     * @var \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking
     *
     * @ManyToOne  (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking", inversedBy="files")
     * @JoinColumn (name="trackingId", referencedColumnName="id")
     */
    protected $trackingDetails;

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

    /**
     * Get Order ID
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->getTrackingDetails()->getShipment()->getParcel()->getOrder()->getOrderId();
    }

    /**
     * Assemble path for save into DB
     *
     * @param string $path Path
     *
     * @return string
     */
    protected function assembleSavePath($path)
    {
        return $this->getOrderId() . LC_DS . parent::assembleSavePath($path);
    }

    /**
     * Get valid file system storage root
     *
     * @return string
     */
    protected function getStoreFileSystemRoot()
    {
        $path = parent::getStoreFileSystemRoot() . $this->getOrderId() . LC_DS;

        \Includes\Utils\FileManager::mkdirRecursive($path);

        return $path;
    }
    
    // }}}
    
    /**
     * Get allowed document types
     *
     * @param string $type Document type to get (OPTIONAL)
     *
     * @return array
     */
    public static function getAllowedDoctypes($type = null)
    {
        $list = array(
            static::DOCTYPE_SIGN_IMAGE => 'Signature image',
            static::DOCTYPE_DCONG_CERT => 'Delivery confirmation certificate',
        );

        return (isset($type)) ? ((isset($list[$type])) ? $list[$type] : null) : $list;
    }

    /**
     * Get file title
     *
     * @return string
     */
    public function getTitle()
    {
        return static::getAllowedDoctypes($this->getDocType());
    }
}
