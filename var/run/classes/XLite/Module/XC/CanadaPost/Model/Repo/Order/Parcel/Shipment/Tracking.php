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

namespace XLite\Module\XC\CanadaPost\Model\Repo\Order\Parcel\Shipment;

/**
 * Tracking repository
 */
class Tracking extends \XLite\Model\Repo\ARepo
{
    // {{{ Remove expired tracking data

    /**
     * Find and remove expired tracking details
     *
     * @return void
     */
    public function removeExpired()
    {
        $list = $this->findAllExpiredDetails();

        if (count($list)) {

            foreach ($list as $tracking) {
                \XLite\Core\Database::getEM()->remove($tracking);
            }

            \XLite\Core\Database::getEM()->flush();
            \XLite\Core\Database::getEM()->clear();
        }
    }

    /**
     * Find all expired tracking details
     *
     * @return \Doctrine\Common\Collection\ArrayCollection
     */
    public function findAllExpiredDetails()
    {
        return $this->defineAllExpiredDetailsQuery()->getResult();
    }

    /**
     * Define query for removeExpired() method
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function defineAllExpiredDetailsQuery()
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.expiry < :time')
            ->setParameter('time', \XLite\Core\Converter::time());
    }

    // }}}
}
