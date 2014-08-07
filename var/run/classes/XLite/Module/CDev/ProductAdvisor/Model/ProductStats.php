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

namespace XLite\Module\CDev\ProductAdvisor\Model;

/**
 * Product statistics model (for 'Customers who viewed this product bought' widget)
 *
 * @Entity (repositoryClass="\XLite\Module\CDev\ProductAdvisor\Model\Repo\ProductStats")
 * @Table  (name="product_stats")
 */
class ProductStats extends \XLite\Model\AEntity
{
    /**
     * Unique ID
     *
     * @var   integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="uinteger")
     */
    protected $stat_id;

    /**
     * Viewed product
     *
     * @var   \XLite\Model\Product
     *
     * @ManyToOne  (targetEntity="XLite\Model\Product", inversedBy="views_stats")
     * @JoinColumn (name="viewed_product_id", referencedColumnName="product_id")
     */
    protected $viewed_product;

    /**
     * Bought product
     *
     * @var   \XLite\Model\Product
     *
     * @ManyToOne  (targetEntity="XLite\Model\Product", inversedBy="purchase_stats")
     * @JoinColumn (name="bought_product_id", referencedColumnName="product_id")
     */
    protected $bought_product;

    /**
     * Count of bought products
     *
     * @var   integer
     *
     * @Column (type="uinteger")
     */
    protected $count = 1;

    /**
     * Get stat_id
     *
     * @return uinteger 
     */
    public function getStatId()
    {
        return $this->stat_id;
    }

    /**
     * Set count
     *
     * @param uinteger $count
     * @return ProductStats
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Get count
     *
     * @return uinteger 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set viewed_product
     *
     * @param XLite\Model\Product $viewedProduct
     * @return ProductStats
     */
    public function setViewedProduct(\XLite\Model\Product $viewedProduct = null)
    {
        $this->viewed_product = $viewedProduct;
        return $this;
    }

    /**
     * Get viewed_product
     *
     * @return XLite\Model\Product 
     */
    public function getViewedProduct()
    {
        return $this->viewed_product;
    }

    /**
     * Set bought_product
     *
     * @param XLite\Model\Product $boughtProduct
     * @return ProductStats
     */
    public function setBoughtProduct(\XLite\Model\Product $boughtProduct = null)
    {
        $this->bought_product = $boughtProduct;
        return $this;
    }

    /**
     * Get bought_product
     *
     * @return XLite\Model\Product 
     */
    public function getBoughtProduct()
    {
        return $this->bought_product;
    }
}