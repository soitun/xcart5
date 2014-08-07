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
 * Category model
 * @MappedSuperClass
 */
abstract class Category extends \XLite\Model\CategoryAbstract implements \XLite\Base\IDecorator
{
    /**
     * Featured products (relation)
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Module\CDev\FeaturedProducts\Model\FeaturedProduct", mappedBy="category", cascade={"all"})
     */
    protected $featuredProducts;

    /**
     * Constructor
     *
     * @param array $data Entity properties OPTIONAL
     *
     * @return void
     */
    public function __construct(array $data = array())
    {
        $this->featuredProducts = new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct($data);
    }

    public function getFeaturedProductsCount()
    {
        return $this->getFeaturedProducts()->count() ?: 0;
    }

    /**
     * Add featuredProducts
     *
     * @param XLite\Module\CDev\FeaturedProducts\Model\FeaturedProduct $featuredProducts
     * @return Category
     */
    public function addFeaturedProducts(\XLite\Module\CDev\FeaturedProducts\Model\FeaturedProduct $featuredProducts)
    {
        $this->featuredProducts[] = $featuredProducts;
        return $this;
    }

    /**
     * Get featuredProducts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFeaturedProducts()
    {
        return $this->featuredProducts;
    }
}