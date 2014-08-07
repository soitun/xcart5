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

namespace XLite\Module\CDev\VAT\Model\Tax;

/**
 * Rate
 *
 * @Entity
 * @Table (name="vat_tax_rates")
 */
class Rate extends \XLite\Model\AEntity
{
    /**
     * Rate type codes
     */
    const TYPE_ABSOLUTE = 'a';
    const TYPE_PERCENT  = 'p';


    /**
     * Rate unique ID
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="uinteger")
     */
    protected $id;

    /**
     * Value
     *
     * @var float
     *
     * @Column (type="decimal", precision=14, scale=4)
     */
    protected $value = 0.0000;

    /**
     * Type
     *
     * @var string
     *
     * @Column (type="fixedstring", length=1)
     */
    protected $type = self::TYPE_PERCENT;

    /**
     * Position
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $position = 0;

    /**
     * Tax (relation)
     *
     * @var \XLite\Module\CDev\VAT\Model\Tax
     *
     * @ManyToOne  (targetEntity="XLite\Module\CDev\VAT\Model\Tax", inversedBy="rates")
     * @JoinColumn (name="tax_id", referencedColumnName="id")
     */
    protected $tax;

    /**
     * Zone (relation)
     *
     * @var \XLite\Model\Zone
     *
     * @ManyToOne  (targetEntity="XLite\Model\Zone")
     * @JoinColumn (name="zone_id", referencedColumnName="zone_id")
     */
    protected $zone;

    /**
     * Tax class (relation)
     *
     * @var \XLite\Model\TaxClass
     *
     * @ManyToOne  (targetEntity="XLite\Model\TaxClass")
     * @JoinColumn (name="tax_class_id", referencedColumnName="id")
     */
    protected $taxClass;

    /**
     * Membership (relation)
     *
     * @var \XLite\Model\Membership
     *
     * @ManyToOne  (targetEntity="XLite\Model\Membership")
     * @JoinColumn (name="membership_id", referencedColumnName="membership_id")
     */
    protected $membership;

    /**
     * For product without tax class
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $noTaxClass = false;

    /**
     * Check if rate is applied by specified zones and membership
     *
     * @param array                   $zones        Zone id list
     * @param \XLite\Model\Membership $membership   Membership OPTIONAL
     * @param \XLite\Model\TaxClass   $taxClass     Tax class OPTIONAL
     * @param boolean                 $skipTaxClass Skip tax class OPTIONAL
     *
     * @return boolean
     */
    public function isApplied(
        array $zones,
        \XLite\Model\Membership $membership = null,
        \XLite\Model\TaxClass $taxClass = null,
        $skipTaxClass = false
    ) {

        $result = $this->getZone() && in_array($this->getZone()->getZoneId(), $zones);

        if ($result && $this->getMembership()) {
            $result = $membership && $this->getMembership()->getMembershipId() == $membership->getMembershipId();
        }

        if ($result && !$skipTaxClass) {
            if ($this->getNoTaxClass()) {
                $result = !$taxClass;

            } else if ($this->getTaxClass()) {
                $result = $taxClass && $this->getTaxClass()->getId() == $taxClass->getId();
            }
        }

        return $result;
    }

    // {{{ Product price calculation

    /**
     * Calculate and return tax rate value for price which includes tax rate
     *
     * @param \XLite\Model\Product $product Product
     * @param float                $price   Price
     *
     * @return float
     */
    public function calculateProductPriceExcludingTax(\XLite\Model\Product $product, $price)
    {
        return $price
            ? $this->calculateValueExcludingTax($price)
            : 0;
    }

    /**
     * Calculate value excluding tax
     *
     * @param float $base Base
     *
     * @return float
     */
    public function calculateValueExcludingTax($base)
    {
        return $this->getType() == static::TYPE_PERCENT
            ? $this->calculatePriceIncludePercent($base)
            : $this->calculatePriceIncludeAbsolute($base);
    }

    /**
     * Calculate product price including tax
     *
     * @param \XLite\Model\Product $product Product
     * @param float                $price   Pure price, without including tax
     *
     * @return float
     */
    public function calculateProductPriceIncludingTax(\XLite\Model\Product $product, $price)
    {
        return $price
            ? $this->calculateValueIncludingTax($price)
            : 0;
    }

    /**
     * Calculate value including tax
     *
     * @param float $base Base
     *
     * @return float
     */
    public function calculateValueIncludingTax($base)
    {
        return $this->getType() == static::TYPE_PERCENT
            ? $this->calculatePriceExcludePercent($base)
            : $this->calculatePriceExcludeAbsolute($base);
    }

    /**
     * Calculate VAT for single product price (percent value)
     *
     * @param float $price Price
     *
     * @return float
     */
    protected function calculatePriceIncludePercent($price)
    {
        return $price - $price / (100 + $this->getValue()) * 100;
    }

    /**
     * Calculate VAT for single product price (absolute value)
     *
     * @param float $price Price
     *
     * @return float
     */
    protected function calculatePriceIncludeAbsolute($price)
    {
        return $this->getValue();
    }

    /**
     * Calculate product price's excluded tax (as percent)
     *
     * @param float $price Product price
     *
     * @return float
     */
    protected function calculatePriceExcludePercent($price)
    {
        return $price * $this->getValue() / 100;
    }

    /**
     * Calculate product price's excluded tax (as absolute)
     *
     * @param float $price Price
     *
     * @return float
     */
    protected function calculatePriceExcludeAbsolute($price)
    {
        return $this->getValue();
    }

    // }}}

    // {{{ Search conditions

    /**
     * Get exclude tax formula
     *
     * @param string $priceField Product price field
     *
     * @return string
     */
    public function getExcludeTaxFormula($priceField)
    {
        return $this->getType() == self::TYPE_PERCENT
            ? $priceField . ' * ' . $this->getValue() . ' / ' . (100 + $this->getValue())
            : $this->getValue();
    }

    /**
     * Get include tax formula
     *
     * @param string $priceField Product price field
     *
     * @return string
     */
    public function getIncludeTaxFormula($priceField)
    {
        return $this->getType() == self::TYPE_PERCENT
            ? $priceField . ' * ' . ((100 + $this->getValue()) / 100)
            : $this->getValue();
    }

    // }}}
}
