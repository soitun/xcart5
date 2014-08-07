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

namespace XLite\Module\CDev\AustraliaPost\View\Model;

/**
 * TestRates widget
 */
class TestRates extends \XLite\View\Model\TestRates
{
    /**
     * Add CSS files
     *
     * @return array
     */
    public function getCSSFiles()
    {
        $list = parent::getCSSFiles();

        $list[] = 'modules/CDev/AustraliaPost/style.css';

        return $list;
    }

    /**
     * Return name of web form widget class
     *
     * @return string
     */
    protected function getFormTarget()
    {
        return 'aupost';
    }

    /**
     * Returns the list of related targets
     *
     * @param string $target Target name
     *
     * @return array
     */
    protected function getAvailableSchemaFields()
    {
        return array(
            static::SCHEMA_FIELD_WEIGHT,
            static::SCHEMA_FIELD_SUBTOTAL,
            static::SCHEMA_FIELD_SRC_COUNTRY,
            static::SCHEMA_FIELD_SRC_ZIPCODE,
            static::SCHEMA_FIELD_DST_COUNTRY,
            static::SCHEMA_FIELD_DST_ZIPCODE,
        );
    }

    /**
     * Alter the default field set
     *
     * @return array
     */
    protected function getTestRatesSchema()
    {
        $result = parent::getTestRatesSchema();

        $result[static::SCHEMA_FIELD_SRC_COUNTRY][static::SCHEMA_CLASS] = 'XLite\View\FormField\Input\Text';
        $result[static::SCHEMA_FIELD_SRC_COUNTRY][static::SCHEMA_ATTRIBUTES] = array('readonly' => 'readonly');

        return $result;
    }

    /**
     * Alter default model object values
     *
     * @return array
     */
    protected function getDefaultModelObjectValues()
    {
        $data = parent::getDefaultModelObjectValues();

        $data[static::SCHEMA_FIELD_SRC_COUNTRY] = 'Australia';

        return $data;
    }
}
