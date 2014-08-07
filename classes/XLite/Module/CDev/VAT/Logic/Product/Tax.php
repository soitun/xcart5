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

namespace XLite\Module\CDev\VAT\Logic\Product;

/**
 * Product tax business logic
 */
class Tax extends \XLite\Module\CDev\VAT\Logic\ATax
{
    // {{{ Product search

    /**
     * Get search price condition
     *
     * @param \XLite\Model\QueryBuilder\AQueryBuilder $queryBuilder Query builder
     * @param string                                  $priceField   Price field name (ex. 'p.price')
     *
     * @return string
     */
    public function getSearchPriceCondition($queryBuilder, $priceField)
    {
        $zones = $this->getZonesList();
        $membership = $this->getMembership();

        $cnd = $priceField;

        foreach ($this->getTaxes() as $tax) {
            $rates = array();
            $includedZones = $tax->getVATZone() ? array($tax->getVATZone()->getZoneId()) : array();
            $taxRates = $tax->getApplicableRates($includedZones, $tax->getVATMembership());
            if (\XLite\Core\Config::getInstance()->CDev->VAT->display_prices_including_vat) {
                $rates = $tax->getApplicableRates($zones, $membership);
                if (
                    $rates
                    && $taxRates
                    && count($rates) == count($taxRates) 
                ) {
                    $identicalCount = 0;
                    foreach ($taxRates as $classId => $rate) {
                        if (
                            isset($rates[$classId])
                            && $rates[$classId]->getId() == $rate->getId()
                        ) {
                            $identicalCount++;
                        }
                    }

                    if ($identicalCount == count($rates)) {
                        $rates = $taxRates = array();
                    }
                }
            }

            if ($taxRates) {
                $cnd .= ' - (';
                foreach ($taxRates as $classId => $rate) {
                    if (-1 == $classId) {
                        $cnd .= 'IF(p.taxClass IS NULL, ';

                    } elseif ($classId) {
                        $alias = 'tax2Classe' . $classId;
                        $queryBuilder->leftJoin('p.taxClass', $alias, 'WITH', $alias . '.id =' . $classId);
                        $cnd .= 'IF(' . $alias . '.id > 0, ';

                    }
                    $cnd .= $rate->getExcludeTaxFormula($priceField);
                    if ($classId) {
                        $cnd .= ', ';
                    }
                }
                if (isset($taxRates[0])) {
                    unset($taxRates[$classId]);

                } else {
                    $cnd .= '0';
                }
                $cnd .= str_repeat(')', count($taxRates) + 1);
            }

            if ($rates) {
                $priceField = $cnd ? '(' . $cnd . ')' : $priceField;
                $cnd = '';
                foreach ($rates as $classId => $rate) {
                    if (-1 == $classId) {
                        $cnd .= 'IF(p.taxClass IS NULL, ';

                    } elseif ($classId) {
                        $alias = 'taxClasse' . $classId;
                        $queryBuilder->leftJoin('p.taxClass', $alias, 'WITH', $alias . '.id =' . $classId);
                        $cnd .= 'IF(' . $alias . '.id > 0, ';

                    }
                    $cnd .= $rate->getIncludeTaxFormula($priceField);
                    if ($classId) {
                        $cnd .= ', ';
                    }
                }
                if (isset($rates[0])) {
                    unset($rates[$classId]);

                } else {
                    $cnd .= '0';
                }
                $cnd .= str_repeat(')', count($rates));
            }
        }

        return $cnd;
    }

    // }}}

    // {{{ Calculation

    /**
     * Calculate product-based included taxes
     * 
     * @param \XLite\Model\Product $product Product
     * @param float                $price   Price OPTIONAL
     *  
     * @return array
     */
    public function calculateProductTaxes(\XLite\Model\Product $product, $price)
    {
        $zones = $this->getZonesList();
        $membership = $this->getMembership();

        $taxes = array();

        foreach ($this->getTaxes() as $tax) {

            $rate = $tax->getFilteredRate($zones, $membership, $product->getTaxClass());

            if ($rate) {
                $taxes[$tax->getName()] = $rate->calculateProductPriceIncludingTax($product, $price);
            }
        }

        return $taxes;
    }

    /**
     * Calculate VAT value for specified product and price
     * 
     * @param \XLite\Model\Product $product Product model object
     * @param float                $price   Price
     *  
     * @return float
     */
    public function getVATValue(\XLite\Model\Product $product, $price)
    {
        $taxes = $this->calculateProductTaxes($product, $price);

        $taxTotal = 0;

        if (!empty($taxes)) {
            foreach ($taxes as $tax) {
                $taxTotal += $tax;
            }
        }

        return $taxTotal;
    }

    /**
     * Calculate product net price
     * 
     * @param \XLite\Model\Product $product Product
     * @param float                $price   Price
     *  
     * @return float
     */
    public function deductTaxFromPrice(\XLite\Model\Product $product, $price)
    {
        foreach ($this->getTaxes() as $tax) {
            $includedZones = $tax->getVATZone() ? array($tax->getVATZone()->getZoneId()) : array();
            $included = $tax->getFilteredRate($includedZones, $tax->getVATMembership(), $product->getTaxClass());

            if ($included) {
                $price -= $included->calculateProductPriceExcludingTax($product, $price);
            }
        }

        return $price;
    }

    // }}}
}
