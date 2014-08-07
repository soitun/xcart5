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

namespace XLite\Module\CDev\Wholesale\Model;

/**
 * Minimum purchase quantity
 *
 * @Entity (repositoryClass="\XLite\Module\CDev\Wholesale\Model\Repo\MinQuantity")
 * @Table (name="product_min_quantities",
 *      uniqueConstraints={
 *          @UniqueConstraint (name="pair", columns={"product_id","membership_id"})
 *      }
 * )
 */
class MinQuantity extends \XLite\Model\AEntity
{
    /**
     * Primary key
     *
     * @var   integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="uinteger")
     */
    protected $id;

    /**
     * Minimum product quantity
     *
     * @var   integer
     *
     * @Column (type="uinteger")
     */
    protected $quantity = 1;

    /**
     * Relation to a membership entity
     *
     * @var   \XLite\Model\Membership
     *
     * @ManyToOne  (targetEntity="XLite\Model\Membership", inversedBy="minQuantities")
     * @JoinColumn (name="membership_id", referencedColumnName="membership_id")
     */
    protected $membership;

    /**
     * Relation to a product entity
     *
     * @var   \XLite\Model\Product
     *
     * @ManyToOne  (targetEntity="XLite\Model\Product", inversedBy="categoryProducts")
     * @JoinColumn (name="product_id", referencedColumnName="product_id")
     */
    protected $product;

    /**
     * Get id
     *
     * @return uinteger 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param uinteger $quantity
     * @return MinQuantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Get quantity
     *
     * @return uinteger 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set membership
     *
     * @param XLite\Model\Membership $membership
     * @return MinQuantity
     */
    public function setMembership(\XLite\Model\Membership $membership = null)
    {
        $this->membership = $membership;
        return $this;
    }

    /**
     * Get membership
     *
     * @return XLite\Model\Membership 
     */
    public function getMembership()
    {
        return $this->membership;
    }

    /**
     * Set product
     *
     * @param XLite\Model\Product $product
     * @return MinQuantity
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
}