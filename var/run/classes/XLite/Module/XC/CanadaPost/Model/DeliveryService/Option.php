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
 

namespace XLite\Module\XC\CanadaPost\Model\DeliveryService;

/**
 * Class represents a Canada Post delivery service's option
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Base\Common")
 * @Table  (name="capost_delivery_service_options")
 */
class Option extends \XLite\Model\AEntity
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
     * Option code
     *
     * @var string
     *
     * @Column (type="string", length=255, nullable=false)
     */
    protected $code;

    /**
     * Option name
     * TODO: remove that field and make getting an option name by a function
     *
     * @var string
     *
     * @Column (type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * Indicates whether this option is mandatory for the service
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $mandatory = false;

    /**
     * True indicates that this option if selected must include a qualifier on the option.
     * This is true for insurance (COV) and collect on delivery (COD) options
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $qualifierRequired = false;

    /**
     * Numeric – indicates the maximum value of the qualifier for this service.
     * The maximum value of a qualifier may differ between services. This is specific to the insurance (COV) option.
     *
     * @var float
     *
     * @Column (type="decimal", precision=14, scale=4, nullable=true)
     */
    protected $qualifierMax = 0.0000;

    /**
     * Item's service (reference to the item's service model)
     *
     * @var \XLite\Module\XC\CanadaPost\Model\DeliveryService
     *
     * @ManyToOne  (targetEntity="XLite\Module\XC\CanadaPost\Model\DeliveryService", inversedBy="options")
     * @JoinColumn (name="serviceId", referencedColumnName="id")
     */
    protected $service;

    // {{{ Service methods

    /**
     * Assign the service
     *
     * @param \XLite\Module\XC\CanadaPost\Model\DeliveryService $service Item's service model (OPTIONAL)
     *
     * @return void
     */
    public function setService(\XLite\Module\XC\CanadaPost\Model\DeliveryService $service = null)
    {
        $this->service = $service;
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
     * Set code
     *
     * @param string $code
     * @return Option
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Option
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set mandatory
     *
     * @param boolean $mandatory
     * @return Option
     */
    public function setMandatory($mandatory)
    {
        $this->mandatory = $mandatory;
        return $this;
    }

    /**
     * Get mandatory
     *
     * @return boolean 
     */
    public function getMandatory()
    {
        return $this->mandatory;
    }

    /**
     * Set qualifierRequired
     *
     * @param boolean $qualifierRequired
     * @return Option
     */
    public function setQualifierRequired($qualifierRequired)
    {
        $this->qualifierRequired = $qualifierRequired;
        return $this;
    }

    /**
     * Get qualifierRequired
     *
     * @return boolean 
     */
    public function getQualifierRequired()
    {
        return $this->qualifierRequired;
    }

    /**
     * Set qualifierMax
     *
     * @param decimal $qualifierMax
     * @return Option
     */
    public function setQualifierMax($qualifierMax)
    {
        $this->qualifierMax = $qualifierMax;
        return $this;
    }

    /**
     * Get qualifierMax
     *
     * @return decimal 
     */
    public function getQualifierMax()
    {
        return $this->qualifierMax;
    }

    /**
     * Get service
     *
     * @return XLite\Module\XC\CanadaPost\Model\DeliveryService 
     */
    public function getService()
    {
        return $this->service;
    }
}