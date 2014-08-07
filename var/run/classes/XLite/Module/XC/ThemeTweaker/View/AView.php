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

namespace XLite\Module\XC\ThemeTweaker\View;

/**
 * Abstract widget
 */
abstract class AView extends \XLite\Module\XC\ColorSchemes\View\AView implements \XLite\Base\IDecorator
{
    /**
     * Get list of methods, priorities and interfaces for the resources
     *
     * @return array
     */
    protected static function getResourcesSchema()
    {
        $schema = parent::getResourcesSchema();
        $schema[] =  array('getThemeTweakerCustomFiles', 1000, 'custom');

        return $schema;
    }

    /**
     * Return custom common files
     *
     * @return array
     */
    protected function getThemeTweakerCustomFiles()
    {
        $files = array();

        if (
            !\XLite::isAdminZone()
        ) {
            if (
                \XLite\Core\Config::getInstance()->XC->ThemeTweaker->use_custom_js
            ) {
                $files[static::RESOURCE_JS] = array(
                    array(
                        'file'  => 'theme/custom.js',
                        'media' => 'all'
                    )
                );
            }

            if (
                \XLite\Core\Config::getInstance()->XC->ThemeTweaker->use_custom_css
            ) {
                $files[static::RESOURCE_CSS] = array(
                    array(
                        'file'  => 'theme/custom.css',
                        'media' => 'all'
                    )
                );
            }
        }

        return $files;
    }
}
