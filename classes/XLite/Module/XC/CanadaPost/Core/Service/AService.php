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

namespace XLite\Module\XC\CanadaPost\Core\Service;

/**
 * Abstract Canada Post service class
 */
abstract class AService extends \XLite\Module\XC\CanadaPost\Core\API
{
    // {{{ Common methods

    /**
     * Adjust float $value with $precision and within limits ($min and $max)
     *
     * @param float $value     Amount
     * @param int   $precision Precision
     * @param float $min       Min amount
     * @param float $max       Max amount
     *
     * @return float
     */
    public static function adjustFloatValue($value, $precision, $min, $max)
    {
        return min($max, max($min, \XLite\Logic\Math::getInstance()->round($value, $precision)));
    }

    // }}}
}
