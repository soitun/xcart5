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

namespace XLite\Model\Category;

/**
 * Category quick flags
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Category\QuickFlags")
 * @Table  (name="category_quick_flags")
 */
class QuickFlags extends \XLite\Model\AEntity
{
    /**
     * Doctrine ID
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="uinteger")
     */
    protected $id;

    /**
     * Total number of subcategories
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $subcategories_count_all = 0;

    /**
     * Number of enabled subcategories
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $subcategories_count_enabled = 0;

    /**
     * Relation to a category entity
     *
     * @var \XLite\Model\Category
     *
     * @OneToOne   (targetEntity="XLite\Model\Category", inversedBy="quickFlags")
     * @JoinColumn (name="category_id", referencedColumnName="category_id")
     */
    protected $category;

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
     * Set subcategories_count_all
     *
     * @param integer $subcategoriesCountAll
     * @return QuickFlags
     */
    public function setSubcategoriesCountAll($subcategoriesCountAll)
    {
        $this->subcategories_count_all = $subcategoriesCountAll;
        return $this;
    }

    /**
     * Get subcategories_count_all
     *
     * @return integer 
     */
    public function getSubcategoriesCountAll()
    {
        return $this->subcategories_count_all;
    }

    /**
     * Set subcategories_count_enabled
     *
     * @param integer $subcategoriesCountEnabled
     * @return QuickFlags
     */
    public function setSubcategoriesCountEnabled($subcategoriesCountEnabled)
    {
        $this->subcategories_count_enabled = $subcategoriesCountEnabled;
        return $this;
    }

    /**
     * Get subcategories_count_enabled
     *
     * @return integer 
     */
    public function getSubcategoriesCountEnabled()
    {
        return $this->subcategories_count_enabled;
    }

    /**
     * Set category
     *
     * @param XLite\Model\Category $category
     * @return QuickFlags
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