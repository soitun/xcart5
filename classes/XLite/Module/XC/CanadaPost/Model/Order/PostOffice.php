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

namespace XLite\Module\XC\CanadaPost\Model\Order;

/**
 * Class represents an Canada Post post office whice was selected for order
 *
 * @Entity
 * @Table  (name="order_capost_office")
 */
class PostOffice extends \XLite\Model\AEntity
{
    /**
     * Unique ID
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="uinteger")
     */
    protected $id;

    /**
     * Reference to the order model
     *
     * @var \XLite\Model\Order
     *
     * @OneToOne   (targetEntity="XLite\Model\Order", inversedBy="capostOffice")
     * @JoinColumn (name="orderId", referencedColumnName="order_id")
     */
    protected $order;

    /**
     * The internal Canada Post assigned unique ID for a Post Office
     * (Field pattern: "\d{10}", has leading zeros)
     *
     * @var string
     *
     * @Column (type="fixedstring", length=10)
     */
    protected $officeId;

    /**
     * The name assigned to the Post Office
     * (Max length: 40)
     *
     * @var string
     *
     * @Column (type="string", length=40)
     */
    protected $name;

    /**
     * The location of a Post Office. This is used to distinguish among various Post Offices that have similar names.
     * (Max length: 40)
     *
     * @var string
     *
     * @Column (type="string", length=40)
     */
    protected $location;

    /**
     * The distance (in KM) to the Post Office from the location specified in the query
     * (min: 0, max: 99999.99, fraction: 2)
     *
     * @var float
     *
     * @Column (type="decimal", precision=12, scale=2)
     */
    protected $distance = 0.00;

    /**
     * True indicates that the Post Office provides bilingual services (English and French)
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $bilingualDesignation = false;

    /**
     * Municipality in which the Post Office is located
     * (Max length: 40)
     *
     * @var string
     *
     * @Column (type="string", length=40)
     */
    protected $city;

    /**
     * The latitude of the Post Office
     * (min: 40, max: 90, fraction: 5)
     *
     * @var float
     *
     * @Column (type="decimal", precision=15, scale=5)
     */
    protected $latitude;

    /**
     * The longitude of the Post Office
     * (min: -150, max: -50, fraction: 5)
     * 
     * @var float
     *
     * @Column (type="decimal", precision=15, scale=5)
     */
    protected $longitude;

    /**
     * The Postal Code of the Post Office
     *
     * @var string
     *
     * @Column (type="string", length=20)
     */
    protected $postalCode;

    /**
     * The province where the Post Office is located
     *
     * @var string
     *
     * @Column (type="string", length=64)
     */
    protected $province;

    /**
     * Street number and name for a Post Office
     * (Max length: 64)
     *
     * @var string
     *
     * @Column (type="string", length=64)
     */
    protected $officeAddress;

    /**
     * Working hours list
     *
     * @var array
     *
     * @Column (type="array")
     */
    protected $workingHours;

    // {{{ Service methods
    
    /**
     * Set order
     *
     * @param \XLite\Model\Order $order Order object (OPTIONAL)
     *
     * @return void
     */

/*     
    public function setOrder(\XLite\Model\Order $order = null)
    {
        $this->order = $order;
    }
*/

    // }}
}
