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

namespace XLite\Module\XC\CanadaPost\Model\Repo;

/**
 * Class represents a Canada Post return repository
 */
class ProductsReturn extends \XLite\Model\Repo\ARepo
{
    /**
     * Allowable search params
     */
    const P_LIMIT      = 'limit';
    const P_STATUS     = 'status';
    const P_DATE_RANGE = 'dateRange';
    const P_SUBSTRING  = 'substring';
    const P_ORDER_BY   = 'orderBy';

    // {{{ Search: main methods and definitions

    /**
     * Current search condition
     *
     * @var \XLite\Core\CommonCell
     */
    protected $currentSearchCnd = null;

    /**
     * Common search
     *
     * @param \XLite\Core\CommonCell $cnd       Search condition
     * @param boolean                $countOnly Return items list or only its size OPTIONAL
     *
     * @return \Doctrine\ORM\PersistentCollection|integer
     */
    public function search(\XLite\Core\CommonCell $cnd, $countOnly = false)
    {
        $qb = $this->createQueryBuilder('r')
            ->innerJoin('r.order', 'o');

        $this->currentSearchCnd = $cnd;

        foreach ($this->currentSearchCnd as $key => $value) {
            $this->callSearchConditionHandler($value, $key, $qb, $countOnly);
        }

        return ($countOnly)
            ? $this->searchCount($qb)
            : $this->searchResult($qb);
    }

    /**
     * Search count only routine
     *
     * @param \Doctrine\ORM\QueryBuilder $qb Query builder routine
     *
     * @return \Doctrine\ORM\PersistentCollection|integer
     */
    public function searchCount(\Doctrine\ORM\QueryBuilder $qb)
    {
        $qb->select('COUNT(DISTINCT r.id)');

        return intval($qb->getSingleScalarResult());
    }

    /**
     * Search result routine
     *
     * @param \Doctrine\ORM\QueryBuilder $qb Query builder routine
     *
     * @return \Doctrine\ORM\PersistentCollection|integer
     */
    public function searchResult(\Doctrine\ORM\QueryBuilder $qb)
    {
        return $qb->getResult();
    }

    /**
     * Call corresponded method to handle a search condition
     *
     * @param mixed                      $value     Condition data
     * @param string                     $key       Condition name
     * @param \Doctrine\ORM\QueryBuilder $qb        Query builder to prepare
     * @param boolean                    $countOnly Flag: get all rows or just count them
     *
     * @return void
     */
    protected function callSearchConditionHandler($value, $key, \Doctrine\ORM\QueryBuilder $qb, $countOnly)
    {
        if ($this->isSearchParamHasHandler($key)) {

            $this->{'prepareCnd' . ucfirst($key)}($qb, $value, $countOnly);

        } else {

            // TODO - add logging here
        }
    }

    /**
     * Check if param can be used for search
     *
     * @param string $param Name of param to check
     *
     * @return boolean
     */
    protected function isSearchParamHasHandler($param)
    {
        return in_array($param, $this->getHandlingSearchParams());
    }

    /**
     * Return list of handling search params
     *
     * @return array
     */
    protected function getHandlingSearchParams()
    {
        return array(
            static::P_LIMIT,
            static::P_STATUS,
            static::P_DATE_RANGE,
            static::P_SUBSTRING,
            static::P_ORDER_BY,
        );
    }

    // }}}

    // {{{ Prepare search conditions

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $qb        Query builder to prepare
     * @param array                      $value     Condition data
     * @param boolean                    $countOnly "Count only" flag
     *
     * @return void
     */
    protected function prepareCndLimit(\Doctrine\ORM\QueryBuilder $qb, array $value, $countOnly)
    {
        $qb->setFrameResults($value);
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $qb        Query builder to prepare
     * @param string                     $value     Condition data
     * @param boolean                    $countOnly "Count only" flag
     *
     * @return void
     */
    protected function prepareCndStatus(\Doctrine\ORM\QueryBuilder $qb, $value, $countOnly)
    {
        if (!empty($value)) {

            if (is_array($value)) {

                $qb->andWhere($qb->expr()->in('r.status', $value));

            } else {

                $qb->andWhere('r.status = :status')
                    ->setParameter('status', $value);
            }
        }
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $qb        Query builder to prepare
     * @param integer                    $value     Condition data
     * @param boolean                    $countOnly "Count only" flag
     *
     * @return void
     */
    protected function prepareCndDateRange(\Doctrine\ORM\QueryBuilder $qb, $value, $countOnly)
    {
        if (!empty($value)) {
            list($start, $end) = \XLite\View\FormField\Input\Text\DateRange::convertToArray($value);
            if ($start) {
                $qb->andWhere('r.date >= :start')
                    ->setParameter('start', $start);
            }

            if ($end) {
                $qb->andWhere('r.date <= :end')
                    ->setParameter('end', $end);
            }
        }
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $qb        Query builder to prepare
     * @param integer                    $value     Condition data
     * @param boolean                    $countOnly "Count only" flag
     *
     * @return void
     */
    protected function prepareCndSubstring(\Doctrine\ORM\QueryBuilder $qb, $value, $countOnly)
    {
        if (!empty($value)) {

            $number = $value;

            if (preg_match('/^\d+$/Ss', $number)) {
                $number = intval($number);
            }

            $qb->andWhere($qb->expr()->orX('r.id = :substring', 'o.orderNumber = :substring'))
                ->setParameter('substring', $number);
        }
    }

    /**
     * Prepare certain search condition
     *
     * @param \Doctrine\ORM\QueryBuilder $qb        Query builder to prepare
     * @param array                      $value     Condition data
     * @param boolean                    $countOnly "Count only" flag
     *
     * @return void
     */
    protected function prepareCndOrderBy(\Doctrine\ORM\QueryBuilder $qb, array $value, $countOnly)
    {
        if (!$countOnly) {

            list($sort, $order) = $this->getSortOrderValue($value);

            $qb->addOrderBy($sort, $order);
        }
    }

    // }}}
}