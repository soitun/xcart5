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

namespace XLite\View\ItemsList\Model\Product\Admin;

/**
 * Products with low inventory list block (for dashboard page)
 */
class LowInventoryBlock extends \XLite\View\ItemsList\Model\Product\Admin\Search
{
    /**
     * Get URL of 'More...' link
     *
     * @return string
     */
    public function getMoreLink()
    {
        return $this->buildURL(
            'product_list',
            'search',
            array(
                \XLite\Model\Repo\Product::P_INVENTORY => \XLite\Model\Repo\Product::INV_LOW,
            )
        );
    }

    /**
     * Get title of 'More...' link
     *
     * @return string
     */
    public function getMoreLinkTitle()
    {
        return static::t('View all low inventory products');
    }

    /**
     * Do not need the create button with this list
     *
     * @return string
     */
    protected function getCreateURL()
    {
        return null;
    }

    /**
     * Return title
     *
     * @return string
     */
    protected function getHead()
    {
        return null;
    }

    /**
     * Define items list columns
     *
     * @return array
     */
    protected function defineColumns()
    {
        $allowedColumns = array(
            'sku',
            'name',
            'qty',
        );

        $columns = parent::defineColumns();

        // Remove redundant columns
        foreach ($columns as $k => $v) {
            $columns[$k][static::COLUMN_SORT] = null;
            if (!in_array($k, $allowedColumns)) {
                unset($columns[$k]);
            }
        }

        return $columns;
    }

    /**
     * Hide left actions
     *
     * @return array
     */
    protected function getLeftActions()
    {
        return array();
    }

    /**
     * Add link to product to the right actions
     *
     * @return array
     */
    protected function getRightActions()
    {
        $list = parent::getRightActions();
        $list[] = $this->getDir() . '/' . $this->getPageBodyDir() . '/product/action.link.tpl';

        return $list;
    }

    /**
     * Hide panel
     *
     * @return null
     */
    protected function getPanelClass()
    {
        return null;
    }

    /**
     * Mark all items as non-removable
     *
     * @return boolean
     */
    protected function isRemoved()
    {
        return false;
    }

    /**
     * Get pager class
     *
     * @return string
     */
    protected function getPagerClass()
    {
        return 'XLite\View\Pager\Admin\Model\Block';
    }

    /*
     * getEmptyListTemplate
     *
     * @return string
     */
    protected function getEmptyListTemplate()
    {
        return $this->getDir() . '/' . $this->getPageBodyDir() . '/product/empty_low_inventory_list.tpl';
    }

    /**
     * Prepare search condition
     *
     * @return \XLite\Core\CommonCell
     */
    protected function getSearchCondition()
    {
        $result = parent::getSearchCondition();

        $result->{\XLite\Model\Repo\Product::P_INVENTORY} = \XLite\Model\Repo\Product::INV_LOW;
        $result->{\XLite\Model\Repo\Product::P_ORDER_BY} = array('i.amount');

        return $result;
    }
}
