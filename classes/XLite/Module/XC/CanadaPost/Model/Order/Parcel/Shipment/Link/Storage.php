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
 * @Entity
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
}
