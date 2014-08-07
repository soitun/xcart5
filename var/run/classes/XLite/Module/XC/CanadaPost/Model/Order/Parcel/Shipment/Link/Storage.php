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

namespace XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link;

/**
 * Link's storage 
 *
 * @Entity (repositoryClass="\XLite\Module\XC\CanadaPost\Model\Repo\Order\Parcel\Shipment\Link\Storage")
 * @Table  (name="order_capost_parcel_shipment_link_storage")
 */
class Storage extends \XLite\Model\Base\Storage
{
    // {{{ Associations

    /**
     * Relation to a link
     *
     * @var \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link
     *
     * @OneToOne   (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link", inversedBy="storage")
     * @JoinColumn (name="linkId", referencedColumnName="id")
     */
    protected $link;

    // }}}

    // {{{ Service operations

    /**
     * Set link
     *
     * @param \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link $link Link object (OPTIONAL)
     *
     * @return void
     */
    public function setLink(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link $link = null)
    {
        $this->link = $link;
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
        return $this->getLink()->getShipment()->getParcel()->getOrder()->getOrderId() . LC_DS . parent::assembleSavePath($path);
    }

    /**
     * Get valid file system storage root
     *
     * @return string
     */
    protected function getStoreFileSystemRoot()
    {
        $path = parent::getStoreFileSystemRoot() . $this->getLink()->getShipment()->getParcel()->getOrder()->getOrderId() . LC_DS;

        \Includes\Utils\FileManager::mkdirRecursive($path);

        return $path;
    }

    // }}}

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
     * Set path
     *
     * @param string $path
     * @return Storage
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return Storage
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * Get fileName
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set mime
     *
     * @param string $mime
     * @return Storage
     */
    public function setMime($mime)
    {
        $this->mime = $mime;
        return $this;
    }

    /**
     * Get mime
     *
     * @return string 
     */
    public function getMime()
    {
        return $this->mime;
    }

    /**
     * Set storageType
     *
     * @param string $storageType
     * @return Storage
     */
    public function setStorageType($storageType)
    {
        $this->storageType = $storageType;
        return $this;
    }

    /**
     * Set size
     *
     * @param uinteger $size
     * @return Storage
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Get size
     *
     * @return uinteger 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set date
     *
     * @param uinteger $date
     * @return Storage
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return uinteger 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get link
     *
     * @return XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link 
     */
    public function getLink()
    {
        return $this->link;
    }
}