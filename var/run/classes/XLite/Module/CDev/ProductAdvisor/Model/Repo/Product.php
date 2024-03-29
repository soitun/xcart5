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

namespace XLite\Module\CDev\ProductAdvisor\Model\Repo;

/**
 * The Product model repository extension
 */
abstract class Product extends \XLite\Module\CDev\Bestsellers\Model\Repo\Product implements \XLite\Base\IDecorator
{
    /**
     * Allowable search params
     */
    const P_ARRIVAL_DATE      = 'arrivalDate';
    const P_PROFILE_ID        = 'profileId';
    const P_VIEWED_PRODUCT_ID = 'viewedProductId';
    const P_PA_GROUP_BY       = 'paGroupBy';


    // {{{ findByProductIds

    /**
     * Find products by product Ids
     *
     * @param array   $productIds Array of product IDs
     * @param boolean $countOnly  Flag for count only case
     *
     * @return \Doctrine\ORM\PersistentCollection|integer
     */
    public function findByProductIds($productIds, $countOnly = false)
    {
        $qb = $this->defineFindByProductIdsQuery($productIds);
        if ($countOnly) {
            $qb->select('COUNT(DISTINCT p.product_id)');
        }

        return $countOnly ? intval($qb->getSingleScalarResult()) : $qb->getResult();
    }

    /**
     * Prepare query builder
     *
     * @param array $productIds Array of product IDs
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function defineFindByProductIdsQuery($productIds)
    {
        $qb = $this->createQueryBuilder('p');

        $this->addEnabledCondition($qb, 'p');

        if (1 < count($productIds)) {
            $qb->andWhere('p.product_id IN (' . implode(', ', $productIds) . ')');

        } else {
            $qb->andWhere('p.product_id = :productId')
                ->setParameter('productId', array_pop($productIds));
        }

        return $qb;
    }

    // }}}

    // {{{ Search functionallity extension

    /**
     * Add arrivalDate to the list of handling search params
     *
     * @return array
     */
    protected function getHandlingSearchParams()
    {
        $params = parent::getHandlingSearchParams();

        $params[] = self::P_ARRIVAL_DATE;
        $params[] = self::P_PROFILE_ID;
        $params[] = self::P_VIEWED_PRODUCT_ID;
        $params[] = self::P_PA_GROUP_BY;

        return $params;
    }

    /**
     * Disable checking if product is up-to-date
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder object
     * @param string                     $alias        Entity alias OPTIONAL
     *
     * @return void
     */
    protected function addDateCondition(\Doctrine\ORM\QueryBuilder $queryBuilder, $alias = null)
    {
        if (!\XLite\Core\Config::getInstance()->CDev->ProductAdvisor->cs_enabled) {
            parent::addDateCondition($queryBuilder, $alias);
        }
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param array                      $value        Condition data
     *
     * @return void
     */
    protected function prepareCndArrivalDate(\Doctrine\ORM\QueryBuilder $queryBuilder, $value)
    {
        if (is_array($value) && 2 == count($value)) {

            $min = intval(trim(array_shift($value)));
            $max = intval(trim(array_shift($value)));

            $min = (0 == $min ? null : $min);
            $max = (0 == $max ? null : $max);

            $this->assignArrivalDateRangeCondition($queryBuilder, $min, $max);
        }
    }

    /**
     * Assign arrivalDate range-based search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder
     * @param float                      $min          Minimum OPTIONAL
     * @param float                      $max          Maximum OPTIONAL
     *
     * @return void
     */
    protected function assignArrivalDateRangeCondition(\Doctrine\ORM\QueryBuilder $queryBuilder, $min = null, $max = null)
    {
        if (isset($min)) {
            $queryBuilder->andWhere('p.arrivalDate > :minDate')
                ->setParameter('minDate', doubleval($min));
        }

        if (isset($max)) {
            $queryBuilder->andWhere('p.arrivalDate < :maxDate')
                ->setParameter('maxDate', doubleval($max));
        }
    }

    // }}}

    // {{{ findProductsOrderedByUsers

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param array                      $value        Condition data
     *
     * @return void
     */
    protected function prepareCndProfileId(\Doctrine\ORM\QueryBuilder $queryBuilder, $value)
    {
        $queryBuilder->addSelect('COUNT(p.product_id) as cnt')
            ->innerJoin('p.order_items', 'oi')
            ->innerJoin('oi.order', 'o');

        if (is_array($value) && 1 < count($value)) {
            $queryBuilder->innerJoin(
                'o.orig_profile',
                'profile',
                'WITH',
                'profile.profile_id IN (' . implode(',', $value) . ')'
            );

        } else {
            $queryBuilder->innerJoin('o.orig_profile', 'profile', 'WITH', 'profile.profile_id = :profileId')
                ->setParameter('profileId', is_array($value) ? array_pop($value) : $value);
        }
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param string                     $value        Parameter for GROUP BY
     *
     * @return void
     */
    protected function prepareCndPaGroupBy(\Doctrine\ORM\QueryBuilder $queryBuilder, $value)
    {
        $queryBuilder->groupBy($value);
    }

    // }}}

    // {{{ findBoughtProducts

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $queryBuilder Query builder to prepare
     * @param array                      $value        Condition data
     *
     * @return void
     */
    protected function prepareCndViewedProductId(\Doctrine\ORM\QueryBuilder $queryBuilder, $value)
    {
        $queryBuilder->innerJoin('p.purchase_stats', 'bp');

        if (is_array($value) && 1 < count($value)) {
            $queryBuilder->innerJoin(
                'bp.viewed_product',
                'vp',
                'WITH',
                'vp.product_id IN (' . implode(',', $value) . ')'
            );

        } else {
            $queryBuilder->innerJoin('bp.viewed_product', 'vp', 'WITH', 'vp.product_id = :productId')
                ->setParameter('productId', is_array($value) ? array_pop($value) : $value);
        }

        return $queryBuilder;
    }

    // }}}
}
