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

namespace XLite\Module\XC\ColorSchemes\View\Menu\Admin;

/**
 * Top links widget
 */
abstract class TopLinks extends \XLite\View\Menu\Admin\TopLinks implements \XLite\Base\IDecorator
{
    /**
     * Define and set handler attributes; initialize handler
     *
     * @param array $params Handler params OPTIONAL
     *
     * @return void
     */
    public function __construct(array $params = array())
    {
        if (
            !isset($this->relatedTargets['css_js_performance'])
            || empty($this->relatedTargets['css_js_performance'])
        ) {
            $this->relatedTargets['css_js_performance'] = array();
        }

        if (!in_array('select_skin', $this->relatedTargets['css_js_performance'])) {
            $this->relatedTargets['css_js_performance'][] = 'select_skin';
        }

        parent::__construct();
    }

    /**
     * Skin selection page must be the first one in the Look & Feel section
     *
     * @return array
     */
    protected function defineItems()
    {
        $items = parent::defineItems();
        $items['system_settings'][self::ITEM_CHILDREN]['css_js'] = array(
            self::ITEM_TITLE      => 'Look & Feel',
            self::ITEM_TARGET     => 'select_skin',
            self::ITEM_WEIGHT     => 300,
        );

        $this->relatedTargets['select_skin'] = $this->relatedTargets['css_js_performance'];
        unset($this->relatedTargets['css_js_performance']);

        return $items;
    }
}
