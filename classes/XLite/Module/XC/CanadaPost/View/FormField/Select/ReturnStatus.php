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

namespace XLite\Module\XC\CanadaPost\View\FormField\Select;

/**
 * Post return status selector
 */
class ReturnStatus extends \XLite\View\FormField\Select\Regular
{
    /**
     * Widget param names
     */
    const PARAM_ALL_OPTION = 'allOption';

    /**
     * Register JS files
     *
     * @return array
     */
    public function getJSFiles()
    {
        $list = parent::getJSFiles();

        $list[] = 'modules/XC/CanadaPost/form_field/return_status.js';

        return $list;
    }

    /**
     * Assemble classes
     *
     * @param array $classes Classes
     *
     * @return array
     */
    protected function assembleClasses(array $classes)
    {
        $classes = parent::assembleClasses($classes);

        $classes[] = 'capost-return-status';

        if ($this->isAllParamOptionEnabled()) {
            $classes[] = 'no-disable';
        }

        return $classes;
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
            static::PARAM_ALL_OPTION  => new \XLite\Model\WidgetParam\Bool(
                'Show "All statuses" option', false, false
            ),
        );
    }

    /**
     * getOptions
     *
     * @return array
     */
    protected function getOptions()
    {
        $list = $this->getDefaultOptions();

        if ($this->isAllParamOptionEnabled()) {
            // Add new element to the top of the list
            $list = array_merge(
                array('' => static::t('All statuses')),
                $list
            );
        }

        return $list;
    }

    /**
     * Return default options list
     *
     * @return array
     */
    protected function getDefaultOptions()
    {
        $list = \XLite\Module\XC\CanadaPost\Model\ProductsReturn::getAllowedStatuses();

        foreach ($list as $k => $v) {
            $list[$k] = static::t($v);
        }

        return $list;
    }

    /**
     * Check - is PARAM_ALL_OPTION option is enabled
     *
     * @return boolean
     */
    protected function isAllParamOptionEnabled()
    {
        return $this->getParam(static::PARAM_ALL_OPTION);
    }
}
