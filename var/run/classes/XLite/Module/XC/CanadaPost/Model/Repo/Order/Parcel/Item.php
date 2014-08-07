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

namespace XLite\Module\XC\CanadaPost\Model\Repo\Order\Parcel;

/**
 * Class represents a Canada Post parcel items repository
 */
class Item extends \XLite\Model\Repo\ARepo
{
    /**
     * Allowable search params
     */
    const P_PARCEL_ID = 'parcelId';

    /**
     * Move item from a parcel to an another parcel or a new one
     *
     * @param integer        $itemId   Item ID
     * @param integer        $amount   Amount
     * @param integet|string $parcelId Parcel ID or "NEW" string for new parcels
     *
     * @return void
     */ 
    public function moveItem($itemId, $amount, $parcelId)
    {
        $amount = intval($amount);

        // Get parcel item model
        $item = $this->find($itemId);

        if (!$item->getParcel()->isEditable()) {
            // item cannt be moved - parcel is not editable
            $item = null;
        }

        if (isset($item)) {

            $amount = min($amount, $item->getAmount());

            // Get parcel model or create new one
            if ($parcelId == 'NEW') {

                $parcel = $item->getParcel()->cloneEntity(false);

                $parcel->setNumber($parcel->getOrder()->countCapostParcels() + 1);
                $parcel->create();

            } else {

                $parcel = \XLite\Core\Database::getRepo('\XLite\Module\XC\CanadaPost\Model\Order\Parcel')->find($parcelId);
            }

            if (!$parcel->isEditable()) {
                // item cannt be moved to here - parcel is not editable
                $parcel = null;
            }

            if (isset($parcel)) {

                // Parcel successfully created or found, so we can move the item

                $newItem = null;

                if ($parcel->hasItems()) {

                    // Try to find the same item
                    foreach ($parcel->getItems() as $_item) {

                        if ($item->getOrderItem()->getItemId() == $_item->getOrderItem()->getItemId()) {
                            $newItem = $_item;
                            break;
                        }
                    }
                }

                if (!isset($newItem)) {

                    // Create new item object
                    $newItem = new \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Item();
                    \XLite\Core\Database::getEM()->persist($newItem);

                    $newItem->setParcel($parcel);
                    $newItem->setOrderItem($item->getOrderItem());

                    $newItem->setWeight($item->getWeight());
                }

                $newItem->setAmount($newItem->getAmount() + $amount);

                $item->setAmount($item->getAmount() - $amount);

                if ($item->getAmount() <= 0) {
                    // Remove item
                    $item->delete();
                }

                \XLite\Core\Database::getEM()->flush();
            }
        }
    }

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
     * @param boolean                $countOnly Return items list or only its size (OPTIONAL)
     *
     * @return \Doctrine\ORM\PersistentCollection|integer
     */
    public function search(\XLite\Core\CommonCell $cnd, $countOnly = false)
    {
        $qb = $this->createQueryBuilder('i')
            ->innerJoin('i.parcel', 'p');

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
        $qb->select('COUNT(DISTINCT i.id)');

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
     * Return list of handling search params
     *
     * @return array
     */
    protected function getHandlingSearchParams()
    {
        return array(
            static::P_PARCEL_ID,
        );
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

    // }}}

    // {{{ Search: prepare conditions

    /**
     * Prepare "parcel ID" condition
     *
     * @param \Doctrine\ORM\QueryBuilder $qb    Query builder to prepare
     * @param integer                    $value Parcel ID
     *
     * @return void
     */
    protected function prepareCndParcelId(\Doctrine\ORM\QueryBuilder $qb, $value)
    {
        if (!empty($value)) {

            $qb->andWhere('p.id = :parcelId')
                ->setParameter('parcelId', $value);
        }
    }

    // }}}
}
