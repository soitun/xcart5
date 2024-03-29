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

namespace XLite\Module\XC\Upselling\Model;

/**
 * Product
 * @MappedSuperClass
 */
abstract class Product extends \XLite\Module\XC\Reviews\Model\Product implements \XLite\Base\IDecorator
{
    /**
     * Upselling products (relation)
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Module\XC\Upselling\Model\UpsellingProduct", mappedBy="product", cascade={"all"})
     */
    protected $upsellingProducts;

    /**
     * Upselling products (relation)
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Module\XC\Upselling\Model\UpsellingProduct", mappedBy="product", cascade={"all"})
     */
    protected $upsellingParentProducts;

    /**
     * Constructor
     *
     * @param array $data Entity properties OPTIONAL
     *
     * @return void
     */
    public function __construct(array $data = array())
    {
        $this->upsellingProducts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->upsellingParentProducts = new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct($data);
    }

    /**
     * Add upsellingProducts
     *
     * @param XLite\Module\XC\Upselling\Model\UpsellingProduct $upsellingProducts
     * @return Product
     */
    public function addUpsellingProducts(\XLite\Module\XC\Upselling\Model\UpsellingProduct $upsellingProducts)
    {
        $this->upsellingProducts[] = $upsellingProducts;
        return $this;
    }

    /**
     * Get upsellingProducts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUpsellingProducts()
    {
        return $this->upsellingProducts;
    }

    /**
     * Add upsellingParentProducts
     *
     * @param XLite\Module\XC\Upselling\Model\UpsellingProduct $upsellingParentProducts
     * @return Product
     */
    public function addUpsellingParentProducts(\XLite\Module\XC\Upselling\Model\UpsellingProduct $upsellingParentProducts)
    {
        $this->upsellingParentProducts[] = $upsellingParentProducts;
        return $this;
    }

    /**
     * Get upsellingParentProducts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUpsellingParentProducts()
    {
        return $this->upsellingParentProducts;
    }
}