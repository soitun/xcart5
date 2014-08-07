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

namespace XLite\Module\XC\CanadaPost\View\Menu\Admin;

/**
 * Top menu widget
 */
abstract class TopMenu extends \XLite\View\Menu\Admin\TopMenu implements \XLite\Base\IDecorator
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
        if (!isset($this->relatedTargets['capost_returns'])) {
            $this->relatedTargets['capost_returns'] = array('capost_return');
        }

        parent::__construct();
    }

    /**
     * Define items
     *
     * @return array
     */
    protected function defineItems()
    {
        $items = parent::defineItems();
		
        if (isset($items['sales'])) {

            $items['sales'][static::ITEM_CHILDREN]['capost_returns'] = array(
                static::ITEM_TITLE      => 'Returns',
                static::ITEM_TARGET     => 'capost_returns',
                static::ITEM_PERMISSION => 'manage orders',
                static::ITEM_WEIGHT     => 400,
            );
        }

        return $items;
	}
}
