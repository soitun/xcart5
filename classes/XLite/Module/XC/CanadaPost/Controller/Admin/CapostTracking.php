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

namespace XLite\Module\XC\CanadaPost\Controller\Admin;

/**
 * Canada Post shipmet tracking controller
 */
class CapostTracking extends \XLite\Controller\Admin\AAdmin
{
    /**
     * Controller parameters
     *
     * @var array
     */
    protected $params = array('target', 'shipment_id');

    /**
     * Define and set handler attributes; initialize handler
     *
     * @param array $params Handler params (OPTIONAL)
     *
     * @return void
     */
    public function __construct(array $params = array())
    {
        parent::__construct($params);
        
        // Remove all expired tracking info
        \XLite\Core\Database::getRepo('XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking')->removeExpired();
    }

    /**
     * Return the current page title (for the content area)
     *
     * @return string
     */
    public function getTitle()
    {
        return static::t('Tracking details');
    }

    /**
     * Check ACL permissions
     *
     * @return boolean
     */
    public function checkACL()
    {
        return (
            (
                parent::checkACL() 
                || \XLite\Core\Auth::getInstance()->isPermissionAllowed('manage orders')
            )
            && $this->getShipment()
        );
    }

    /**
     * Get shipment data
     *
     * @return \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment|null
     */
    public function getShipment()
    {
        $shipmentId = intval(\XLite\Core\Request::getInstance()->shipment_id);
        
        return \XLite\Core\Database::getRepo('XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment')->find($shipmentId);
    }

    /**
     * Get tracking details
     *
     * @return \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking|null
     */
    public function getTrackingDetails()
    {
        $trackingDetails = null;

        if ($this->getShipment()) {
            $trackingDetails = $this->getShipment()->getTrackingDetails();
        }

        return $trackingDetails;
    }
}
