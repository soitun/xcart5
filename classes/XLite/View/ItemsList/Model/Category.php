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

namespace XLite\View\ItemsList\Model;

/**
 * Categories items list
 */
class Category extends \XLite\View\ItemsList\Model\Table
{

    /**
     * Create counter 
     * 
     * @var   integer
     */
    protected $createCount = 0;

    /**
     * Get a list of CSS files required to display the widget properly
     *
     * @return array
     */
    public function getCSSFiles()
    {
        $list = parent::getCSSFiles();

        $list[] = 'items_list/model/table/category/style.css';

        return $list;
    }

    /**
     * Get category
     *
     * @return \XLite\Model\Category
     */
    protected function getCategory()
    {
        return \XLite\Core\Request::getInstance()->id
            ? \XLite\Core\Database::getRepo('XLite\Model\Category')->find(intval(\XLite\Core\Request::getInstance()->id))
            : \XLite\Core\Database::getRepo('XLite\Model\Category')->getRootCategory();
    }

    /**
     * Check - current category is root cCategory or not
     *
     * @return boolean
     */
    protected function isRootCategory()
    {
        return !\XLite\Core\Request::getInstance()->id
            || \XLite\Core\Request::getInstance()->id == \XLite\Core\Database::getRepo('XLite\Model\Category')->getRootCategoryId();
    }

    /**
     * Get formatted path of current category
     *
     * @return string
     */
    protected function getFormattedPath()
    {
        $list = array();

        foreach ($this->getCategory()->getPath() as $category) {
            $list[] = '<a href="' . static::buildURL('categories', '', array('id' => $category->getCategoryId())). '">'
                . func_htmlspecialchars($category->getName())
                . '</a>';
        }

        return implode(' :: ', $list);
    }

    /**
     * Define columns structure
     *
     * @return array
     */
    protected function defineColumns()
    {
        return array(
            'image' => array(
                static::COLUMN_NAME          => '',
                static::COLUMN_CLASS         => 'XLite\View\FormField\Inline\FileUploader\Image',
                static::COLUMN_CREATE_CLASS  => 'XLite\View\FormField\Inline\EmptyField',
                static::COLUMN_PARAMS        => array('required' => false),
                static::COLUMN_ORDERBY       => 100,
            ),
            'name' => array(
                static::COLUMN_NAME          => \XLite\Core\Translation::lbl('Category'),
                static::COLUMN_CLASS         => 'XLite\View\FormField\Inline\Input\Text',
                static::COLUMN_PARAMS        => array('required' => true),
                static::COLUMN_ORDERBY       => 200,
                static::COLUMN_NO_WRAP       => true,
                static::COLUMN_MAIN          => true,
            ),
            'info' => array(
                static::COLUMN_NAME          => \XLite\Core\Translation::lbl('Products'),
                static::COLUMN_TEMPLATE      => false,
                static::COLUMN_ORDERBY       => 300,
            ),
            'subcategories' => array(
                static::COLUMN_NAME          => \XLite\Core\Translation::lbl('Subcat'),
                static::COLUMN_TEMPLATE      => false,
                static::COLUMN_ORDERBY       => 400,
            ),
            'edit' => array(
                static::COLUMN_NAME          => '',
                static::COLUMN_TEMPLATE      => false,
                static::COLUMN_ORDERBY       => 500,
            ),
        );
    }

    /**
     * Create entity
     *
     * @return \XLite\Model\AEntity
     */
    protected function createEntity()
    {
        $entity = parent::createEntity();

        $parent = null;
        if (\XLite\Core\Request::getInstance()->id) {
            $parent = \XLite\Core\Database::getRepo('XLite\Model\Category')->find(intval(\XLite\Core\Request::getInstance()->id));
        }

        if (!$parent) {
            $parent = \XLite\Core\Database::getRepo('XLite\Model\Category')->getRootCategory();
        }

        $entity->setParent($parent);

        // Resort
        $pos = $this->createCount * 10;
        $entity->setPos($pos);
        foreach ($parent->getChildren() as $child) {
            $pos += 10;
            $child->setPos($pos);
        }

        $this->createCount++;

        return $entity;
    }

    /**
     * Insert new entity
     *
     * @param \XLite\Model\AEntity $entity Entity
     *
     * @return void
     */
    protected function insertNewEntity(\XLite\Model\AEntity $entity)
    {
        $entity->setCleanURL(
            \XLite\Core\Database::getRepo('XLite\Model\Category')->generateCleanURL($entity, $entity->getName())
        );

        parent::insertNewEntity($entity);
    }

    /**
     * Define repository name
     *
     * @return string
     */
    protected function defineRepositoryName()
    {
        return 'XLite\Model\Category';
    }

    /**
     * Get create entity URL
     *
     * @return string
     */
    protected function getCreateURL()
    {
        return \XLite\Core\Converter::buildUrl(
            'category',
            null,
            array(
                'parent' => $this->getCategory()->getCategoryId(),
            )
        );
    }

    /**
     * Get create button label
     *
     * @return string
     */
    protected function getCreateButtonLabel()
    {
        return 'New category';
    }

    // {{{ Behaviors

    /**
     * Creation button position
     *
     * @return integer
     */
    protected function isCreation()
    {
        return static::CREATE_INLINE_TOP;
    }

    /**
     * Inline creation mechanism position
     *
     * @return integer
     */
    protected function isInlineCreation()
    {
        return static::CREATE_INLINE_TOP;
    }

    /**
     * Mark list as removable
     *
     * @return boolean
     */
    protected function isRemoved()
    {
        return true;
    }

    /**
     * Mark list as switchyabvle (enable / disable)
     *
     * @return boolean
     */
    protected function isSwitchable()
    {
        return true;
    }

    /**
     * Mark list as sortable
     *
     * @return integer
     */
    protected function getSortableType()
    {
        return static::SORT_TYPE_MOVE;
    }

    // }}}

    /**
     * Get container class
     *
     * @return string
     */
    protected function getContainerClass()
    {
        return parent::getContainerClass() . ' categories';
    }

    /**
     * Get panel class
     *
     * @return \XLite\View\Base\FormStickyPanel
     */
    protected function getPanelClass()
    {
        return 'XLite\View\StickyPanel\ItemsList\Category';
    }

    /**
     * Check - table header is visible or not
     *
     * @return boolean
     */
    protected function isHeaderVisible()
    {
        return true;
    }

    /**
     * isFooterVisible
     *
     * @return boolean
     */
    protected function isFooterVisible()
    {
        return true;
    }

    // {{{ Search

    /**
     * Return search parameters.
     *
     * @return array
     */
    static public function getSearchParams()
    {
        return array();
    }

    /**
     * Return params list to use for search
     * TODO refactor
     *
     * @return \XLite\Core\CommonCell
     */
    protected function getSearchCondition()
    {
        $result = parent::getSearchCondition();

        foreach (static::getSearchParams() as $modelParam => $requestParam) {
            $paramValue = $this->getParam($requestParam);

            if ('' !== $paramValue && 0 !== $paramValue) {
                $result->$modelParam = $paramValue;
            }
        }

        $result->{\XLite\Model\Repo\Category::SEARCH_PARENT} = \XLite\Core\Request::getInstance()->id
            ? intval(\XLite\Core\Request::getInstance()->id)
            : \XLite\Core\Database::getRepo('XLite\Model\Category')->getRootCategoryId();

        return $result;
    }

    // }}}

}
