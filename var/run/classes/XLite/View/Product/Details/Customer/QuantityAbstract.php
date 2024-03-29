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

namespace XLite\View\Product\Details\Customer;

/**
 * Quantity widget
 */
abstract class QuantityAbstract extends \XLite\View\Product\Details\Customer\Widget
{
    const PARAM_QUANTITY = 'quantity';

    /**
     * Define widget parameters
     *
     * @return void
     */
    protected function defineWidgetParams()
    {
        parent::defineWidgetParams();

        $this->widgetParams += array(
            static::PARAM_QUANTITY  => new \XLite\Model\WidgetParam\Int('Value', null),
        );
    }

    /**
     * Alias
     *
     * @return integer
     */
    protected function getQuantity()
    {
        return $this->getParam(static::PARAM_QUANTITY);
    }

    /**
     * Define the CSS classes
     *
     * @return string
     */
    protected function getCSSClass()
    {
        return 'product-qty';
    }

    /**
     * Return directory contains the template
     *
     * @return string
     */
    protected function getDefaultTemplate()
    {
        return 'product/quantity/body.tpl';
    }

    /**
     * Return the specific widget service name to make it visible as specific CSS class
     *
     * @return null|string
     */
    public function getFingerprint()
    {
        return 'widget-fingerprint-product-quantity';
    }

    /**
     * Check if widget is visible
     *
     * @return boolean
     */
    protected function isVisible()
    {
        return parent::isVisible() && $this->isProductAvailableForSale();
    }

    /**
     * Check - product is available for sale or not
     *
     * @return boolean
     */
    protected function isProductAvailableForSale()
    {
        return $this->getProduct()->isAvailable();
    }

    /**
     * Return maximum allowed quantity
     *
     * @return integer
     */
    protected function getMaxQuantity()
    {
        return null;
    }
}
