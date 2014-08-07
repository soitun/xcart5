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

namespace XLite\Module\CDev\VAT\Model;

/**
 * Product option surcharge
 *
 * @LC_Dependencies ("CDev\ProductOptions")
 */
class OptionSurcharge extends \XLite\Module\CDev\ProductOptions\Model\OptionSurcharge implements \XLite\Base\IDecorator
{
    /**
     * Get surcharge absolute value
     *
     * @return float
     */
    public function getDisplaySurchargePrice()
    {
        $value = parent::getAbsoluteValue();

        $product = $this->getOption()->getGroup()->getProduct();

        $value = \XLite\Module\CDev\VAT\Logic\Product\Tax::getInstance()->deductTaxFromPrice($product, $value);

        if (\XLite\Core\Config::getInstance()->CDev->VAT->display_prices_including_vat) {
            $value += \XLite\Module\CDev\VAT\Logic\Product\Tax::getInstance()->getVATValue($product, $value);
        }

        return $value;
    }
}
