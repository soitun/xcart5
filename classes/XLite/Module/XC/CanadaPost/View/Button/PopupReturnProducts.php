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

namespace XLite\Module\XC\CanadaPost\View\Button;

/**
 * Return products button widget
 */
class PopupReturnProducts extends \XLite\View\Button\APopupButton
{
    /**
     * Additional parameters
     */
    const PARAM_ORDER_ID = 'orderId';

    /**
     * Register JS files
     *
     * @return array
     */
    public function getJSFiles()
    {
        $list = parent::getJSFiles();

        $list[] = 'modules/XC/CanadaPost/button/js/popup_return_products.js';

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
        
        // Include create return page widget styles to show the page properly in the popup window
        $list[] = 'modules/XC/CanadaPost/products_return/create/style.css';

        return $list;
    }

    /**
     * Return URL parameters to use in AJAX popup
     *
     * @return array
     */
    protected function prepareURLParams()
    {
        return array(
            'target'   => 'capost_returns',
            'widget'   => '\XLite\Module\XC\CanadaPost\View\ReturnProducts',
            'order_id' => $this->getOrderId(),
        );
    }

    /**
     * GEt default button label
     *
     * @return string
     */
    protected function getDefaultLabel()
    {
        return static::t('Return products');
    }

    /**
     * Define widget params
     *
     * @return void
     */
    protected function defineWidgetParams()
    {
        parent::defineWidgetParams();

        $this->widgetParams += array(
            static::PARAM_ORDER_ID => new \XLite\Model\WidgetParam\Int('Order ID', 0),
        );
    }
    
    /**
     * Get order ID
     *
     * @return integer
     */
    protected function getOrderId()
    {
        return $this->getParam(static::PARAM_ORDER_ID);
    }

    /**
     * Return CSS classes
     *
     * @return string
     */
    protected function getClass()
    {
        return trim(parent::getClass() . ' capost-return-products-button ' . ($this->getParam(self::PARAM_STYLE) ?: ''));
    }
}
