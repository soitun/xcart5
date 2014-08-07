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
 
namespace XLite\Module\XC\CanadaPost\Model;

/**
 * Class represents a Canada Post delivery service
 *
 * @Entity (repositoryClass="XLite\Module\XC\CanadaPost\Model\Repo\DeliveryService")
 * @Table  (name="capost_delivery_services",
 *      uniqueConstraints={
 *          @UniqueConstraint(name="code_country", columns={"code", "countryCode"})
 *      }
 * )
 * @HasLifecycleCallbacks
 */
class DeliveryService extends \XLite\Model\AEntity
{
    /**
     * Maximum time to live (in seconds)
     */
    const MAX_TTL = 259200; // 60 * 60 * 24 * 3 = 3 days

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
     * Service code
     *
     * @var string
     *
     * @Column (type="string", length=32, nullable=false)
     */
    protected $code;

    /**
     * Country
     *
     * @var string
     *
     * @Column (type="string", length=2)
     */
    protected $countryCode = '';

    /**
     * Service name
     *
     * @var string
     *
     * @Column (type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * Service expiration time (UNIX timestamp)
     *
     * @var integer
     *
     * @Column (type="uinteger")
     */
    protected $expiry;

    /**
     * Maximum weight that can be sent using this service (in grams)
     *
     * @param integer
     *
     * @Column (type="integer", nullable=false)
     */
    protected $maxWeight = 0;

    /**
     * Minimum weight that can be sent using this service (in grams)
     *
     * @param integer
     *
     * @Column (type="integer", nullable=false)
     */
    protected $minWeight = 0;

    /**
     * Maximum size of the longest dimension of an item (in cm)
     *
     * @var float
     *
     * @Column (type="decimal", precision=11, scale=1)
     */
    protected $maxLength = 0.0;

    /**
     * Minimum size of the longest dimension of an item (in cm)
     *
     * @var float
     *
     * @Column (type="decimal", precision=11, scale=1)
     */
    protected $minLength = 0.0;

    /**
     * Maximum size of the second longest dimension of an item (in cm)
     *
     * @var float
     *
     * @Column (type="decimal", precision=11, scale=1)
     */
    protected $maxWidth = 0.0;

    /**
     * Minimum size of the second longest dimension of an item (in cm)
     *
     * @var float
     *
     * @Column (type="decimal", precision=11, scale=1)
     */
    protected $minWidth = 0.0;

    /**
     * Maximum size of the shortest dimension of an item (in cm)
     *
     * @var float
     *
     * @Column (type="decimal", precision=11, scale=1)
     */
    protected $maxHeight = 0.0;

    /**
     * Maximum size of the shortest dimension of an item (in cm)
     *
     * @var float
     *
     * @Column (type="decimal", precision=11, scale=1)
     */
    protected $minHeight = 0.0;

    /**
     * Maximum calculated value of length + 2*width + 2*height (in cm)
     *
     * @var float
     *
     * @Column (type="decimal", precision=11, scale=1, nullable=true)
     */
    protected $lengthPlusGirthMax;

    /**
     * Maximum value of length + width + height (in cm)
     *
     * @var float
     *
     * @Column (type="decimal", precision=11, scale=1, nullable=true)
     */
    protected $lengthHeightWidthSumMax;

    /**
     * If any dimension exceeds this limit an oversize fee will apply to the shipment (in cm)
     *
     * @var float
     *
     * @Column (type="decimal", precision=11, scale=1, nullable=true)
     */
    protected $oversizeLimit;

    /**
     * Standard density factor used to calculate cubed weight (in grams)
     *
     * @var integer
     *
     * @Column (type="integer", nullable=true)
     */
    protected $densityFactor;

    /**
     * True indicates that parcels shipped with this service can be shipped in a mailing tube (option CYL can be used)
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $canShipInMailingTube = false;

    /**
     * True indicates that parcels shipped with this service can be shipped unpackaged (option UP can be used)
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $canShipUnpackaged = false;

    /**
     * True indicates that this service can be used in the return-spec of a Create Shipment request
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $allowedAsReturnService = false;

    /**
     * Service options (reference to the service's options model)
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Module\XC\CanadaPost\Model\DeliveryService\Option", mappedBy="service", cascade={"all"})
     */
    protected $options;

    // {{{ Service methods

    /**
     * Add an option to service
     *
     * @param \XLite\Module\XC\CanadaPost\Model\DeliveryService\Option $newOption Service option model
     *
     * @return void
     */
    public function addOption(\XLite\Module\XC\CanadaPost\Model\DeliveryService\Option $newOption)
    {
        $newOption->setService($this);

        $this->addOptions($newOption);
    }

    // }}}

    /**
     * Check - is delivery service data is expired or not
     *
     * @return boolean
     */
    public function isExpired()
    {
        return (\XLite\Core\Converter::time() > $this->getExpiry());
    }

    /**
     * Update expiration time
     *
     * @return void
     */
    public function updateExpiry()
    {
        $this->setExpiry(\XLite\Core\Converter::time() + static::MAX_TTL);
    }

    // {{{ Lifecycle callbacks

    /**
     * Prepare before saving
     *
     * @PrePersist
     *
     * @return void
     */
    public function prepareBeforeSave()
    {
        if (
            !is_numeric($this->expiry)
            || !is_int($this->expiry)
        ) {
            $this->updateExpiry();
        }
    }

    // }}}
}
