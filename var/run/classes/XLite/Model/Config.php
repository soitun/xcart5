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

namespace XLite\Model;

/**
 * DB-based configuration registry
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Config")
 * @Table  (name="config",
 *      uniqueConstraints={
 *          @UniqueConstraint (name="nc", columns={"name", "category"})
 *      },
 *      indexes={
 *          @Index (name="orderby", columns={"orderby"}),
 *          @Index (name="type", columns={"type"})
 *      }
 * )
 */
class Config extends \XLite\Model\Base\I18n
{
    /**
     * Name for the Shipping category options
     */
    const SHIPPING_CATEGORY = 'Shipping';

    /**
     * Prefix for the shipping values
     */
    const SHIPPING_VALUES_PREFIX = 'anonymous_';

    /**
     * Option unique name
     *
     * @var string
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column (type="integer")
     */
    protected $config_id;

    /**
     * Option name
     *
     * @var string
     *
     * @Column (type="string", length=32)
     */
    protected $name;

    /**
     * Option category
     *
     * @var string
     *
     * @Column (type="string", length=32)
     */
    protected $category;

    /**
     * Option type
     * Allowed values:'','text','textarea','checkbox','country','state','select','serialized','separator'
     *     or forrm field class name
     *
     * @var string
     *
     * @Column (type="string", length=128)
     */
    protected $type = '';

    /**
     * Option position within category
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $orderby = 0;

    /**
     * Option value
     *
     * @var string
     *
     * @Column (type="text")
     */
    protected $value = '';

    /**
     * Widget parameters
     *
     * @var array
     *
     * @Column (type="array", nullable=true)
     */
    protected $widgetParameters;


    /**
     * Get config_id
     *
     * @return integer 
     */
    public function getConfigId()
    {
        return $this->config_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Config
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
     * Set category
     *
     * @param string $category
     * @return Config
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Config
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set orderby
     *
     * @param integer $orderby
     * @return Config
     */
    public function setOrderby($orderby)
    {
        $this->orderby = $orderby;
        return $this;
    }

    /**
     * Get orderby
     *
     * @return integer 
     */
    public function getOrderby()
    {
        return $this->orderby;
    }

    /**
     * Set value
     *
     * @param text $value
     * @return Config
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return text 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set widgetParameters
     *
     * @param array $widgetParameters
     * @return Config
     */
    public function setWidgetParameters($widgetParameters)
    {
        $this->widgetParameters = $widgetParameters;
        return $this;
    }

    /**
     * Get widgetParameters
     *
     * @return array 
     */
    public function getWidgetParameters()
    {
        return $this->widgetParameters;
    }

    /**
     * Translations (relation). AUTOGENERATED
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Model\ConfigTranslation", mappedBy="owner", cascade={"all"})
     */
    protected $translations;

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getOptionName()
    {
        return $this->getSoftTranslation()->getOptionName();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setOptionName($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setOptionName($value);
    }

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getOptionComment()
    {
        return $this->getSoftTranslation()->getOptionComment();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setOptionComment($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setOptionComment($value);
    }


}