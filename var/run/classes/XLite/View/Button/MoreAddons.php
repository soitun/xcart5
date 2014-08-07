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

namespace XLite\View\Button;

/**
 * More addons link
 *
 * @ListChild (list="modules.pager.buttons", weight="100", zone="admin")
 */
class MoreAddons extends \XLite\View\Button\Link
{
    /**
     * Check if widget is visible
     *
     * @return boolean
     */    
    protected function isVisible()
    {
        return parent::isVisible() 
            && 'addons_list_installed' === \XLite\Core\Request::getInstance()->target
            && !isset(\XLite\Core\Request::getInstance()->recent);
    }
    
    /**
     * Define widget parameters
     *
     * @return void
     */
    protected function defineWidgetParams()
    {
        parent::defineWidgetParams();

        $this->widgetParams[self::PARAM_LOCATION]->setValue($this->buildURL('addons_list_marketplace'));
        $this->widgetParams[self::PARAM_LABEL]->setValue('More add-ons');
        $this->widgetParams[self::PARAM_STYLE]->setValue('more-addons-button');
    }
}
