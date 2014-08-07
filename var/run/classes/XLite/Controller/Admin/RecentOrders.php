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

namespace XLite\Controller\Admin;

/**
 * Orders list controller
 */
class RecentOrders extends \XLite\Controller\Admin\OrderList
{
    /**
     * Return the current page title (for the content area)
     *
     * @return string
     */
    public function getTitle()
    {
        return 'Recent orders';
    }

    /**
     * Define the session cell name for the order list
     *
     * @return string
     */
    protected function getSessionCellName()
    {
        return \XLite\View\ItemsList\Model\Order\Admin\Recent::getSessionCellName();
    }

    /**
     * Define the search params
     *
     * @return array
     */
    protected function getSearchParams()
    {
        return \XLite\View\ItemsList\Model\Order\Admin\Recent::getSearchParams();
    }

    /**
     * Define the items list class
     *
     * @return \XLite\View\ItemsList\Model\Order\Admin\Recent
     */
    protected function getItemsList()
    {
        $list = new \XLite\View\ItemsList\Model\Order\Admin\Recent();

        return $list;
    }

    /**
     * Handles the request.
     *
     * @return void
     */
    public function handleRequest()
    {
        \XLite\Core\Session::getInstance()->{$this->getSessionCellName()} = array(
            \XLite\Model\Repo\Order::P_DATE => array(LC_START_TIME - 86400, LC_START_TIME),
        );

        parent::handleRequest();
    }

}
