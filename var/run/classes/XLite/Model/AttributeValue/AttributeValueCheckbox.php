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

namespace XLite\Model\AttributeValue;

/**
 * Attribute value (checkbox)
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\AttributeValue\AttributeValueCheckbox")
 * @Table  (name="attribute_values_checkbox",
 *      indexes={
 *          @Index (name="product_id", columns={"product_id"}),
 *          @Index (name="attribute_id", columns={"attribute_id"}),
 *          @Index (name="value", columns={"value"})
 *      }
 * )
 */
class AttributeValueCheckbox extends \XLite\Model\AttributeValue\Multiple
{
    /**
     * Value
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $value = false;

    /**
     * Set value
     *
     * @param mixed $value
     *
     * @return \XLite\Model\AttributeValue\AttributeValueCheckbox
     */
    public function setValue($value)
    {
        if ('Y' === $value || 1 === $value) {
            $value = true;

        } else if ('N' === $value || 0 === $value) {
            $value = false;
        }

        $this->value = $value;

        return $this;
    }

    /**
     * Return attribute value as string
     *
     * @return string
     */
    public function asString()
    {
        return static::t($this->getValue() ? 'Yes' : 'No');
    }

    /**
     * Get value
     *
     * @return boolean 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set priceModifier
     *
     * @param decimal $priceModifier
     * @return AttributeValueCheckbox
     */
    public function setPriceModifier($priceModifier)
    {
        $this->priceModifier = $priceModifier;
        return $this;
    }

    /**
     * Get priceModifier
     *
     * @return decimal 
     */
    public function getPriceModifier()
    {
        return $this->priceModifier;
    }

    /**
     * Set priceModifierType
     *
     * @param fixedstring $priceModifierType
     * @return AttributeValueCheckbox
     */
    public function setPriceModifierType($priceModifierType)
    {
        $this->priceModifierType = $priceModifierType;
        return $this;
    }

    /**
     * Get priceModifierType
     *
     * @return fixedstring 
     */
    public function getPriceModifierType()
    {
        return $this->priceModifierType;
    }

    /**
     * Set weightModifier
     *
     * @param decimal $weightModifier
     * @return AttributeValueCheckbox
     */
    public function setWeightModifier($weightModifier)
    {
        $this->weightModifier = $weightModifier;
        return $this;
    }

    /**
     * Get weightModifier
     *
     * @return decimal 
     */
    public function getWeightModifier()
    {
        return $this->weightModifier;
    }

    /**
     * Set weightModifierType
     *
     * @param fixedstring $weightModifierType
     * @return AttributeValueCheckbox
     */
    public function setWeightModifierType($weightModifierType)
    {
        $this->weightModifierType = $weightModifierType;
        return $this;
    }

    /**
     * Get weightModifierType
     *
     * @return fixedstring 
     */
    public function getWeightModifierType()
    {
        return $this->weightModifierType;
    }

    /**
     * Set defaultValue
     *
     * @param boolean $defaultValue
     * @return AttributeValueCheckbox
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * Get defaultValue
     *
     * @return boolean 
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

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
     * Set product
     *
     * @param XLite\Model\Product $product
     * @return AttributeValueCheckbox
     */
    public function setProduct(\XLite\Model\Product $product = null)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get product
     *
     * @return XLite\Model\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set attribute
     *
     * @param XLite\Model\Attribute $attribute
     * @return AttributeValueCheckbox
     */
    public function setAttribute(\XLite\Model\Attribute $attribute = null)
    {
        $this->attribute = $attribute;
        return $this;
    }

    /**
     * Get attribute
     *
     * @return XLite\Model\Attribute 
     */
    public function getAttribute()
    {
        return $this->attribute;
    }
}