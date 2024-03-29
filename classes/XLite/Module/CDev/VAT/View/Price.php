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

namespace XLite\Module\CDev\VAT\View;

/**
 * Price widget 
 */
class Price extends \XLite\View\Price implements \XLite\Base\IDecorator
{
    /**
     * Determine if we need to display 'incl.VAT' note
     *
     * @return boolean
     */
    protected function isVATApplicable()
    {
        $result = false;
        $optionValue = \XLite\Core\Config::getInstance()->CDev->VAT->display_inc_vat_label;

        if (
            ('P' == $optionValue && in_array(\XLite\Core\Request::getInstance()->target, $this->getProductTargets()))
            || 'Y' == $optionValue
        ) {
            $product = $this->getProduct();
            $taxes = $product->getIncludedTaxList();
            $result = !empty($taxes);
        }

        return $result;
    }

    /**
     * Get targets of product pages
     * 
     * @return array
     */
    protected function getProductTargets()
    {
        return array('product', 'quick_look');
    }

    /**
     * Determine if we need to display 'incl.VAT' note
     *
     * @return boolean
     */
    protected function isDisplayedPriceIncludingVAT()
    {
        return \XLite\Core\Config::getInstance()->CDev->VAT->display_prices_including_vat;
    }

    /**
     * Determine if we need to display 'incl.VAT' note
     *
     * @return boolean
     */
    protected function getVATName()
    {
        $tax = \XLite\Core\Database::getRepo('XLite\Module\CDev\VAT\Model\Tax')->getTax();

        return $tax->name;
    }
}
