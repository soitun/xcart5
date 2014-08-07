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
 * Transmit shipment button widget
 */
class TransmitShipment extends \XLite\View\Button\AButton
{
    /**
     * Widget params
     */
    const PARAM_PARCEL_ID = 'parcelId';
    
    /**
     * getJSFiles
     *
     * @return array
     */
    public function getJSFiles()
    {
        $list = parent::getJSFiles();
        $list[] = 'modules/XC/CanadaPost/button/js/transmit_shipment.js';

        return $list;
    }

    /**
     * Register files from common repository
     *
     * @return array
     */
    public function getCommonFiles()
    {
        $list = parent::getCommonFiles();

        $list['js'][] = 'js/jquery.blockUI.js';
        $list['js'][] = 'js/core.popup.js';

        return $list;
    }

    /**
     * Get default button label
     *
     * @return string
     */
    protected function getDefaultLabel()
    {
        return static::t('Transmit shipment');
    }

    /**
     * Return JS parameters
     *
     * @return array
     */
    protected function getJSParams()
    {
        return array(
            'parcel_id'    => $this->getParam(static::PARAM_PARCEL_ID),
            'warning_text' => static::t('Are you sure you want to transmit this shipment?'),
        );
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
            static::PARAM_PARCEL_ID => new \XLite\Model\WidgetParam\Int('Parcel ID', 0),
        );
    }

    /**
     * Return widget default template
     *
     * @return string
     */
    protected function getDefaultTemplate()
    {
        return 'modules/XC/CanadaPost/button/shipment_action.tpl';
    }

    /**
     * Return CSS classes
     *
     * @return string
     */
    protected function getClass()
    {
        return 'capost-button-transmit-shipment ' . ($this->getParam(static::PARAM_STYLE) ?: '');
    }
}
