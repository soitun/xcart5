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
 * Non-delivery handling selector
 */
class NonDeliveryType extends \XLite\View\FormField\Select\Regular
{
    /**
     * Widget param names
     */
    const PARAM_IS_MANDATORY    = 'isMandatory';
    const PARAM_ALLOWED_OPTIONS = 'allowedOptions';

    /**
     * Get default options for selector
     *
     * @return array
     */
    protected function getDefaultOptions()
    {
        $options = \XLite\Module\XC\CanadaPost\Model\Order\Parcel::getValidOptionsByClass(
            \XLite\Module\XC\CanadaPost\Model\Order\Parcel::OPT_CLASS_NON_DELIVERY
        );

        $list = array();

        foreach ($options as $k => $v) {
            $list[$k] = $v[\XLite\Module\XC\CanadaPost\Model\Order\Parcel::OPT_SCHEMA_TITLE];
        }

        return $list;
    }

    /**
     * Get options for selector
     *
     * @return array
     */
    protected function getOptions()
    {
        $list = parent::getOptions();

        foreach ($list as $k => $v) {
            if (!$this->isAllowedOption($k)) {
                // Remove not allowed option
                unset($list[$k]);
            }
        }

        if (!$this->isMandatory()) {
            // Add 'default' option if field is not mandatory
            $list = array_merge(
                array('' => static::t('Not specified')),
                $list
            );
        }

        return $list;
    }

    /**
     * Check - is option is allowed or not
     *
     * @param string $code Options code
     *
     * @return bool
     */
    protected function isAllowedOption($code)
    {
        $result = true;

        $allowedOptions = $this->getParam(static::PARAM_ALLOWED_OPTIONS);

        if (
            isset($allowedOptions)
            && !isset($allowedOptions[$code])
        ) {
            $result = false;
        }

        return $result;
    }

    /**
     * Check - is field is mandatory (one of the options should be selected)
     *
     * @return boolean
     */
    protected function isMandatory()
    {
        return $this->getParam(static::PARAM_IS_MANDATORY);
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
            static::PARAM_IS_MANDATORY    => new \XLite\Model\WidgetParam\Bool(
                'Is mandatory', false, false
            ),
            static::PARAM_ALLOWED_OPTIONS => new \XLite\Model\WidgetParam\Collection(
                'Allowed options', null
            ),
        );
    }
}
