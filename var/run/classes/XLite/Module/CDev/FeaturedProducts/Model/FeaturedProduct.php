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

namespace XLite\Module\CDev\FeaturedProducts\Model;

/**
 * Featured Product
 *
 * @Entity (repositoryClass="\XLite\Module\CDev\FeaturedProducts\Model\Repo\FeaturedProduct")
 * @Table (name="featured_products",
 *      uniqueConstraints={
 *             @UniqueConstraint (name="pair", columns={"category_id","product_id"})
 *      }
 * )
 */

class FeaturedProduct extends \XLite\Model\AEntity
{
    /**
     * Session cell name
     */
    const SESSION_CELL_NAME = 'featuredProductsSearch';

    /**
     * Product + category link unique id
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer")
     */
    protected $id;

    /**
     * Sort position
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $orderBy = 0;

    /**
     * Product (relation)
     *
     * @var \XLite\Model\Product
     *
     * @ManyToOne  (targetEntity="XLite\Model\Product", inversedBy="featuredProducts")
     * @JoinColumn (name="product_id", referencedColumnName="product_id")
     */
    protected $product;

    /**
     * Category (relation)
     *
     * @var \XLite\Model\Category
     *
     * @ManyToOne  (targetEntity="XLite\Model\Category", inversedBy="featuredProducts")
     * @JoinColumn (name="category_id", referencedColumnName="category_id")
     */
    protected $category;


    /**
     * SKU getter
     *
     * @return string
     */
    public function getSku()
    {
        return $this->getProduct()->getSku();
    }

    /**
     * Price getter
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->getProduct()->getPrice();
    }

    /**
     * Amount getter
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->getProduct()->getInventory()->getAmount();
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->getOrderBy();
    }

    /**
     * Set position
     *
     * @param integer $position Category position
     *
     * @return void
     */
    public function setPosition($position)
    {
        return $this->setOrderBy($position);
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set orderBy
     *
     * @param integer $orderBy
     * @return FeaturedProduct
     */
    public function setOrderBy($orderBy)
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    /**
     * Get orderBy
     *
     * @return integer 
     */
    public function getOrderBy()
    {
        return $this->orderBy;
    }

    /**
     * Set product
     *
     * @param XLite\Model\Product $product
     * @return FeaturedProduct
     */
    public function setProduct(\XLite\Model\Product $product = null)
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get product
     *
     * @return XLite\Model\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set category
     *
     * @param XLite\Model\Category $category
     * @return FeaturedProduct
     */
    public function setCategory(\XLite\Model\Category $category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return XLite\Model\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}