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

namespace XLite\Module\CDev\Sale\View;

/**
 * Product options list
 */
class SaleDiscountTypes extends \XLite\View\AView
{
    /**
     * Sale price value name
     */
    const PARAM_SALE_PRICE_VALUE = 'salePriceValue';

    /**
     * Discount type name
     */
    const PARAM_DISCOUNT_TYPE    = 'discountType';


    /**
     * Register JS files
     *
     * @return array
     */
    public function getJSFiles()
    {
        $list = parent::getJSFiles();

        $list[] = 'modules/CDev/Sale/sale_discount_types/js/script.js';

        return $list;
    }

    /**
     * Register CSS files
     *
     * @return array
     */
    public function getCSSFiles()
    {
        $list = parent::getCSSFiles();

        $list[] = 'modules/CDev/Sale/sale_discount_types/css/style.css';

        return $list;
    }

    /**
     * Return widget default template
     *
     * @return string
     */
    protected function getDefaultTemplate()
    {
        return 'modules/CDev/Sale/sale_discount_types/body.tpl';
    }

    /**
     * Return percent off value.
     *
     * @return integer
     */
    protected function getPercentOffValue()
    {
        return intval($this->getParam('salePriceValue'));
    }

    /**
     * Define widget parameters
     *
     * @return void
     */
    protected function defineWidgetParams()
    {
        parent::defineWidgetParams();

        $this->widgetParams += array(
            self::PARAM_SALE_PRICE_VALUE => new \XLite\Model\WidgetParam\Float('Sale price value', 0),
            self::PARAM_DISCOUNT_TYPE    => new \XLite\Model\WidgetParam\String('Discount type', \XLite\Model\Product::SALE_DISCOUNT_TYPE_PERCENT),
        );
    }

}
