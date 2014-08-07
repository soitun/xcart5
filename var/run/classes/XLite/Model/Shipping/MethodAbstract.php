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
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

namespace XLite\Model\Shipping;

/**
 * @MappedSuperClass (repositoryClass="\XLite\Model\Repo\Shipping\Method")
 */
abstract class MethodAbstract extends \XLite\Model\Base\I18n
{
    /**
     * A unique ID of the method
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer")
     */
    protected $method_id;

    /**
     * Processor class name
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $processor = '';

    /**
     * Carrier of the method (for instance, "UPS" or "USPS")
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $carrier = '';

    /**
     * Unique code of shipping method (within processor space)
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $code = '';

    /**
     * Whether the method is enabled or disabled
     *
     * @var string
     *
     * @Column (type="boolean")
     */
    protected $enabled = false;

    /**
     * A position of the method among other registered methods
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $position = 0;

    /**
     * Shipping rates (relation)
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Model\Shipping\Markup", mappedBy="shipping_method", cascade={"all"})
     */
    protected $shipping_markups;

    /**
     * Tax class (relation)
     *
     * @var \XLite\Model\TaxClass
     *
     * @ManyToOne  (targetEntity="XLite\Model\TaxClass")
     * @JoinColumn (name="tax_class_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $taxClass;

    /**
     * Constructor
     *
     * @param array $data Entity properties OPTIONAL
     *
     * @return void
     */
    public function __construct(array $data = array())
    {
        $this->shipping_markups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->classes          = new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct($data);
    }

    /**
     * Get processor class object
     *
     * @return \XLite\Model\Shipping\Processor\AProcessor
     */
    public function getProcessorObject()
    {
        $result = null;

        // Current processor ID
        $processor = $this->getProcessor();

        // List of all registered processors
        $processors = \XLite\Model\Shipping::getInstance()->getProcessors();

        // Search for processor object
        if ($processors) {
            foreach ($processors as $obj) {
                if ($obj->getProcessorId() == $processor) {
                    $result = $obj;
                    break;
                }
            }
        }

        return $result;
    }

    /**
     * Return true if rates exists for this shipping method
     *
     * @return boolean
     */
    public function hasRates()
    {
        return (bool)$this->getRatesCount();
    }

    /**
     * Get count of rates specified for this shipping method
     *
     * @return integer
     */
    public function getRatesCount()
    {
        return count($this->getShippingMarkups());
    }

    /**
     * Get method_id
     *
     * @return integer 
     */
    public function getMethodId()
    {
        return $this->method_id;
    }

    /**
     * Set processor
     *
     * @param string $processor
     * @return Method
     */
    public function setProcessor($processor)
    {
        $this->processor = $processor;
        return $this;
    }

    /**
     * Get processor
     *
     * @return string 
     */
    public function getProcessor()
    {
        return $this->processor;
    }

    /**
     * Set carrier
     *
     * @param string $carrier
     * @return Method
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
        return $this;
    }

    /**
     * Get carrier
     *
     * @return string 
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Method
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
     * Set enabled
     *
     * @param boolean $enabled
     * @return Method
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Method
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add shipping_markups
     *
     * @param XLite\Model\Shipping\Markup $shippingMarkups
     * @return Method
     */
    public function addShippingMarkups(\XLite\Model\Shipping\Markup $shippingMarkups)
    {
        $this->shipping_markups[] = $shippingMarkups;
        return $this;
    }

    /**
     * Get shipping_markups
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getShippingMarkups()
    {
        return $this->shipping_markups;
    }

    /**
     * Set taxClass
     *
     * @param XLite\Model\TaxClass $taxClass
     * @return Method
     */
    public function setTaxClass(\XLite\Model\TaxClass $taxClass = null)
    {
        $this->taxClass = $taxClass;
        return $this;
    }

    /**
     * Get taxClass
     *
     * @return XLite\Model\TaxClass 
     */
    public function getTaxClass()
    {
        return $this->taxClass;
    }

    /**
     * Translations (relation). AUTOGENERATED
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Model\Shipping\MethodTranslation", mappedBy="owner", cascade={"all"})
     */
    protected $translations;

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getName()
    {
        return $this->getSoftTranslation()->getName();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setName($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setName($value);
    }


}