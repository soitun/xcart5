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

namespace XLite\Module\XC\ProductVariants\View\ItemsList\Model;

/**
 * Product variants items list
 */
class ProductVariant extends \XLite\View\ItemsList\Model\Table
{
    const COLUMN_PRODUCT_ATTRIBUTE  = 'product_attribute';

    /**
     * Get column value
     *
     * @param array                $column Column
     * @param \XLite\Model\AEntity $entity Model
     *
     * @return mixed
     */
    protected function getColumnValue(array $column, \XLite\Model\AEntity $entity)
    {
        if (isset($column[static::COLUMN_PRODUCT_ATTRIBUTE])) {
            $result = $entity->getAttributeValue($column[static::COLUMN_PRODUCT_ATTRIBUTE]);
            $result = $result ? $result->asString() : '';

        } else {
            $result = parent::getColumnValue($column, $entity);
        }

        return $result;
    }

    /**
     * Define columns structure
     *
     * @return array
     */
    protected function defineColumns()
    {
        $columns = array();
        $step = 100;
        foreach ($this->getVariantsAttributes() as $a) {
            $columns['attributeValue' . $a->getId()] = array(
                static::COLUMN_NAME              => $a->getName(),
                static::COLUMN_SUBHEADER         =>  static::t(
                    '{{count}} options',
                    array(
                        'count' => count($a->getAttributeValue($this->getProduct()))
                    )
                ),
                static::COLUMN_NO_WRAP           => true,
                static::COLUMN_PRODUCT_ATTRIBUTE => $a,
                static::COLUMN_CREATE_CLASS      => 'XLite\Module\XC\ProductVariants\View\FormField\Inline\Select\AttributeValues',
                static::COLUMN_PARAMS            => array(
                    'attribute' => $a,
                    'product'   => $this->getProduct(),
                ),
                static::COLUMN_ORDERBY  => $step,
            );

            $step += 100;
        }

        return $columns + array(
            'price' => array(
                static::COLUMN_NAME      => static::t('Price'),
                static::COLUMN_SUBHEADER => static::t('Default') . ': ' . $this->formatPrice($this->getProduct()->getPrice()),
                static::COLUMN_CLASS     => 'XLite\Module\XC\ProductVariants\View\FormField\Inline\Input\Text\Price',
                static::COLUMN_EDIT_ONLY => true,
                static::COLUMN_PARAMS    => array(
                    'attributes' => array(
                        'placeholder' => $this->getProduct()->getPrice(),
                    )
                ),
                static::COLUMN_ORDERBY  => $step + 100,
            ),
            'sku' => array(
                static::COLUMN_NAME      => static::t('SKU'),
                static::COLUMN_SUBHEADER => static::t('Default') . ': ' . $this->getProduct()->getSku(),
                static::COLUMN_CLASS     => 'XLite\Module\XC\ProductVariants\View\FormField\Inline\Input\Text\SKU',
                static::COLUMN_EDIT_ONLY => true,
                static::COLUMN_PARAMS    => array(
                    'attributes' => array(
                        'placeholder' => $this->getProduct()->getSku(),
                    )
                ),
                static::COLUMN_ORDERBY  => $step + 200,
            ),
            'amount' => array(
                static::COLUMN_NAME      => static::t('Quantity'),
                static::COLUMN_SUBHEADER => static::t('Default') . ': '
                    . ($this->getProduct()->getInventory()->getEnabled() ? $this->getProduct()->getInventory()->getAmount() : static::t('unlimited')),
                static::COLUMN_CLASS     => 'XLite\Module\XC\ProductVariants\View\FormField\Inline\Input\Text\Amount',
                static::COLUMN_EDIT_ONLY => true,
                static::COLUMN_PARAMS    => array(
                    'attributes' => array(
                        'placeholder' => $this->getProduct()->getInventory()->getEnabled() ? $this->getProduct()->getInventory()->getAmount() : static::t('unlimited'),
                    )
                ),
                static::COLUMN_ORDERBY  => $step + 300,
            ),
            'weight' => array(
                static::COLUMN_NAME      => static::t('Weight'),
                static::COLUMN_SUBHEADER => static::t('Default') . ': ' . $this->formatWeight($this->getProduct()->getWeight()),
                static::COLUMN_CLASS     => 'XLite\Module\XC\ProductVariants\View\FormField\Inline\Input\Text\Weight',
                static::COLUMN_EDIT_ONLY => true,
                static::COLUMN_PARAMS    => array(
                    'attributes' => array(
                        'placeholder' => $this->getProduct()->getWeight(),
                    )
                ),
                static::COLUMN_ORDERBY  => $step + 400,
            ),
        );
    }

    /**
     * Define repository name
     *
     * @return string
     */
    protected function defineRepositoryName()
    {
        return 'XLite\Module\XC\ProductVariants\Model\ProductVariant';
    }

    /**
     * Get create button label
     *
     * @return string
     */
    protected function getCreateButtonLabel()
    {
        return 'Add variant';
    }

    /**
     * Inline creation mechanism position
     *
     * @return integer
     */
    protected function isInlineCreation()
    {
        return $this->isAllowVaraintAdd() ? static::CREATE_INLINE_TOP : null;
    }

    /*
     * Get empty list template
     *
     * @return string
     */
    protected function getEmptyListTemplate()
    {
        return 'modules/XC/ProductVariants/items_list/model/product_variant/empty.tpl';
    }

    // {{{ Behaviors

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
     * Mark list as selectable
     *
     * @return boolean
     */
    protected function isSelectable()
    {
        return true;
    }

    // }}}

    /**
     * Get container class
     *
     * @return string
     */
    protected function getContainerClass()
    {
        return parent::getContainerClass() . ' product_variants';
    }

    /**
     * Get panel class
     *
     * @return \XLite\View\Base\FormStickyPanel
     */
    protected function getPanelClass()
    {
        return null;
    }

    /**
     * Check - pager box is visible or not
     *
     * @return boolean
     */
    protected function isPagerVisible()
    {
        return false;
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

        $result->product = $this->getProduct();

        return $result;
    }

    // }}}

    // {{{ Model processing

    /**
     * Create entity
     *
     * @return \XLite\Model\AEntity
     */
    protected function createEntity()
    {
        $entity = parent::createEntity();

        if (\XLite\Core\Request::getInstance()->isPost()) {
            $product = $this->getProduct();
            $entity->setProduct($product);
            $product->addVariants($entity);
        }

        return $entity;
    }

    /**
     * Remove entity
     *
     * @param \XLite\Model\AEntity $entity Entity
     *
     * @return boolean
     */
    protected function removeEntity(\XLite\Model\AEntity $entity)
    {
        $this->getProduct()->getVariants()->removeElement($entity);
        parent::removeEntity($entity);

        return true;
    }

    // }}}
}
