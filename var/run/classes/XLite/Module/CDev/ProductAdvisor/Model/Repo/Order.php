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

namespace XLite\Module\CDev\ProductAdvisor\Model\Repo;

/**
 * The Order model repository
 */
abstract class Order extends \XLite\Model\Repo\OrderAbstract implements \XLite\Base\IDecorator
{
    /**
     * Find customers who ordered product with specified product ID 
     * Returns array of profile IDs
     * 
     * @param integer $productId Product ID
     *  
     * @return array
     */
    public function findUsersBoughtProduct($productId)
    {
        $result = array();
    
        $data = $this->defineFindUsersBoughtProductQuery($productId)->getResult();

        if ($data) {
            foreach ($data as $row) {
                $result[] = intval($row['profile_id']);
            }
            $result = array_unique($result);
        }

        return $result;
    }

    /**
     * Prepare query builder
     *
     * @param array $productId Product ID
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function defineFindUsersBoughtProductQuery($productId)
    {
        return $this->createQueryBuilder('o')
            ->select('profile.profile_id')
            ->innerJoin('o.items', 'oi')
            ->innerJoin('oi.object', 'product', 'WITH', 'product.product_id = :productId')
            ->innerJoin('o.orig_profile', 'profile')
            ->setParameter('productId', $productId);
    }
}
