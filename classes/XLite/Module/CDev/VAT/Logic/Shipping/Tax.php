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

namespace XLite\Module\CDev\VAT\Logic\Shipping;

/**
 * Tax business logic for shipping cost
 */
class Tax extends \XLite\Module\CDev\VAT\Logic\ATax
{

    // {{{ Calculation

    /**
     * Calculate rate cost
     * 
     * @param \XLite\Model\Shipping\Rate $rate  Rate
     * @param float                      $price Price
     *  
     * @return float
     */
    public function calculateRateCost(\XLite\Model\Shipping\Rate $rate, $price)
    {
        return $this->deductTaxFromPrice($rate, $price);
    }

    /**
     * Calculate shipping net price
     * 
     * @param \XLite\Model\Shipping\Rate $rate  Rate
     * @param float                      $price Price
     *  
     * @return float
     */
    public function deductTaxFromPrice(\XLite\Model\Shipping\Rate $rate, $price)
    {
        $class = $rate->getMethod() && $rate->getMethod()->getTaxClass() 
            ? $rate->getMethod()->getTaxClass() : null;

        foreach ($this->getTaxes() as $tax) {
            $includedZones = $tax->getVATZone() ? array($tax->getVATZone()->getZoneId()) : array();
            $included = $tax->getFilteredRate($includedZones, $tax->getVATMembership(), $class);

            if ($included) {
                $price -= $included->calculateValueExcludingTax($price);
            }
        }

        return $price;
    }

    // }}}
}
