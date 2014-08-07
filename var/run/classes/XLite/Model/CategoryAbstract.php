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

namespace XLite\Model;

/**
 * @MappedSuperClass (repositoryClass="\XLite\Model\Repo\Category")
 */
abstract class CategoryAbstract extends \XLite\Model\Base\Catalog
{
    /**
     * WEB LC root postprocessing constant
     */
    const WEB_LC_ROOT = '{{WEB_LC_ROOT}}';


    /**
     * Node unique ID
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="uinteger")
     */
    protected $category_id;

    /**
     * Node left value
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $lpos;

    /**
     * Node right value
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $rpos;

    /**
     * Node status
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $enabled = true;

    /**
     * Whether to display the category title, or not
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $show_title = true;

    /**
     * Category "depth" in the tree
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $depth = -1;

    /**
     * Category position parameter. Sort inside the parent category
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $pos = 0;

    /**
     * Whether to display the category title, or not
     *
     * @var string
     *
     * @Column (type="string", length=32, nullable=true)
     */
    protected $root_category_look;

    /**
     * Some cached flags
     *
     * @var \XLite\Model\Category\QuickFlags
     *
     * @OneToOne (targetEntity="XLite\Model\Category\QuickFlags", mappedBy="category", cascade={"all"})
     */
    protected $quickFlags;

    /**
     * Memberships
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ManyToMany (targetEntity="XLite\Model\Membership", inversedBy="categories")
     * @JoinTable (name="category_membership_links",
     *      joinColumns={@JoinColumn(name="category_id", referencedColumnName="category_id")},
     *      inverseJoinColumns={@JoinColumn(name="membership_id", referencedColumnName="membership_id")}
     * )
     */
    protected $memberships;

    /**
     * One-to-one relation with category_images table
     *
     * @var \XLite\Model\Image\Category\Image
     *
     * @OneToOne  (targetEntity="XLite\Model\Image\Category\Image", mappedBy="category", cascade={"all"})
     */
    protected $image;

    /**
     * Relation to a CategoryProducts entities
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Model\CategoryProducts", mappedBy="category", cascade={"all"})
     * @OrderBy   ({"orderby" = "ASC"})
     */
    protected $categoryProducts;

    /**
     * Child categories
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Model\Category", mappedBy="parent", cascade={"all"})
     * @OrderBy({"pos" = "ASC","category_id"="ASC","lpos" = "ASC"})
     */
    protected $children;

    /**
     * Parent category
     *
     * @var \XLite\Model\Category
     *
     * @ManyToOne  (targetEntity="XLite\Model\Category", inversedBy="children")
     * @JoinColumn (name="parent_id", referencedColumnName="category_id")
     */
    protected $parent;

    /**
     * Caching flag to check if the category is visible in the parents branch.
     *
     * @var boolean
     */
    protected $flagVisible = null;

    /**
     * Get object unique id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->getCategoryId();
    }

    /**
     * Set parent
     *
     * @param \XLite\Model\Category $parent Parent category OPTIONAL
     *
     * @return void
     */
    public function setParent(\XLite\Model\Category $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * Set image
     *
     * @param \XLite\Model\Image\Category\Image $image Image OPTIONAL
     *
     * @return void
     */
    public function setImage(\XLite\Model\Image\Category\Image $image = null)
    {
        $this->image = $image;
    }

    /**
     * Check if category has image
     *
     * @return boolean
     */
    public function hasImage()
    {
        return !is_null($this->getImage());
    }

    /**
     * Check every parent of category to be enabled.
     *
     * @return boolean
     */
    public function isVisible()
    {
        if (!isset($this->flagVisible)) {
            $current = $this;
            $hidden = false;
            $rootCategoryId = \XLite\Core\Database::getRepo('XLite\Model\Category')->getRootCategoryId();

            while ($rootCategoryId != $current->getCategoryId()) {
                if (!$this->checkStorefrontVisibility($current)) {
                    $hidden = true;
                    break;
                }
                $current = $current->getParent();
            }
            $this->flagVisible = !$hidden;
        }

        return $this->flagVisible;
    }

    /**
     * Check if the category is visible on the storefront for the current customer
     *
     * @return boolean
     */
    protected function checkStorefrontVisibility($current)
    {
        return $current->getEnabled()
            && (
                0 == $current->getMemberships()->count()
                || in_array(\XLite\Core\Auth::getInstance()->getMembershipId(), $current->getMembershipIds())
            );
    }

    /**
     * Get the number of subcategories
     *
     * @return integer
     */
    public function getSubcategoriesCount()
    {
        $result = 0;

        $enabledCondition = $this->getRepository()->getEnabledCondition();
        $quickFlags = $this->getQuickFlags();

        if ($quickFlags) {
            $result = $enabledCondition
                ? $quickFlags->getSubcategoriesCountEnabled()
                : $quickFlags->getSubcategoriesCountAll();
        }

        return $result;
    }

    /**
     * Check if category has subcategories
     *
     * @return boolean
     */
    public function hasSubcategories()
    {
        return 0 < $this->getSubcategoriesCount();
    }

    /**
     * Return subcategories list
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getSubcategories()
    {
        return $this->getChildren()->filter(
            function (\XLite\Model\Category $category) {
                return $category->getEnabled();
            }
        );
    }

    /**
     * Return siblings list.
     * You are able to include itself into this list. (Customer area)
     *
     * @param boolean $hasSelf Flag to include itself
     *
     * @return array
     */
    public function getSiblings($hasSelf = false)
    {
        return $this->getRepository()->getSiblings($this, $hasSelf);
    }

    /**
     * Get category path
     *
     * @return array
     */
    public function getPath()
    {
        return $this->getRepository()->getCategoryPath($this->getCategoryId());
    }

    /**
     * Gets full path to the category as a string: <parent category>/.../<category name>
     *
     * @return string
     */
    public function getStringPath()
    {
        $path = array();

        foreach ($this->getPath() as $category) {
            $path[] = $category->getName();
        }

        return implode('/', $path);
    }

    /**
     * Return parent category ID
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->getParent() ? $this->getParent()->getCategoryId() : 0;
    }

    /**
     * Set parent category ID
     *
     * @param integer $parentID Value to set
     *
     * @return void
     */
    public function setParentId($parentID)
    {
        $this->parent = $this->getRepository()->find($parentID);
    }

    /**
     * Get membership Ids
     *
     * @return array
     */
    public function getMembershipIds()
    {
        $result = array();

        foreach ($this->getMemberships() as $membership) {
            $result[] = $membership->getMembershipId();
        }

        return $result;
    }

    /**
     * Flag if the category and active profile have the same memberships. (when category is displayed or hidden)
     *
     * @return boolean
     */
    public function hasAvailableMembership()
    {
        return 0 == $this->getMemberships()->count()
            || in_array(\XLite\Core\Auth::getInstance()->getMembershipId(), $this->getMembershipIds());
    }

    /**
     * Return number of products associated with the category
     *
     * TODO: check if result of "getProducts()" is cached by Doctrine
     *
     * @return integer
     */
    public function getProductsCount()
    {
        return $this->getProducts(null, true);
    }

    /**
     * Return products list
     *
     * @param \XLite\Core\CommonCell $cnd       Search condition OPTIONAL
     * @param boolean                $countOnly Return items list or only its size OPTIONAL
     *
     * @return array|integer
     */
    public function getProducts(\XLite\Core\CommonCell $cnd = null, $countOnly = false)
    {
        if (!isset($cnd)) {
            $cnd = new \XLite\Core\CommonCell();
        }

        // Main condition for this search
        $cnd->{\XLite\Model\Repo\Product::P_CATEGORY_ID} = $this->getCategoryId();

        return \XLite\Core\Database::getRepo('XLite\Model\Product')->search($cnd, $countOnly);
    }

    /**
     * Count products
     *
     * @param \XLite\Core\CommonCell $cnd       Search condition OPTIONAL
     *
     * @return integer
     */
    public function countProducts(\XLite\Core\CommonCell $cnd = null)
    {
        return $this->getProducts($cnd, true);
    }

    /**
     * Return category description
     *
     * @return string
     */
    public function getViewDescription()
    {
        return str_replace(
            $this->getWebPreprocessingTags(),
            $this->getWebPreprocessingURL(),
            $this->getDescription()
        );
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->getPos();
    }

    /**
     * Set position
     *
     * @param integer $position Product position
     *
     * @return void
     */
    public function setPosition($position)
    {
        return $this->setPos($position);
    }

    /**
     * Constructor
     *
     * @param array $data Entity properties OPTIONAL
     *
     * @return void
     */
    public function __construct(array $data = array())
    {
        $this->categoryProducts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct($data);
    }

    /**
     * Register tags to be replaced with some URLs
     *
     * @return array
     */
    protected function getWebPreprocessingTags()
    {
        return array(
            static::WEB_LC_ROOT,
        );
    }

    /**
     * Register URLs that should be given instead of tags
     *
     * @return array
     */
    protected function getWebPreprocessingURL()
    {
        // Get URL of shop. If the HTTPS is used then it should be cleaned from ?xid=<xid> construction
        $url = \XLite\Core\URLManager::getShopURL(
            null,
            \XLite\Core\Request::getInstance()->isHTTPS(),
            array(),
            null,
            false
        );

        // We are cleaning URL from unnecessary here <xid> construction
        $url = preg_replace('/(\?.*)/', '', $url);

        return array(
            $url,
        );
    }

    /**
     * The main procedure to generate clean URL
     *
     * @return string
     */
    public function generateCleanURL()
    {
        return $this->getRepository()->generateCleanURL($this, $this->getName());
    }


    /**
     * Get category_id
     *
     * @return uinteger 
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set lpos
     *
     * @param integer $lpos
     * @return Category
     */
    public function setLpos($lpos)
    {
        $this->lpos = $lpos;
        return $this;
    }

    /**
     * Get lpos
     *
     * @return integer 
     */
    public function getLpos()
    {
        return $this->lpos;
    }

    /**
     * Set rpos
     *
     * @param integer $rpos
     * @return Category
     */
    public function setRpos($rpos)
    {
        $this->rpos = $rpos;
        return $this;
    }

    /**
     * Get rpos
     *
     * @return integer 
     */
    public function getRpos()
    {
        return $this->rpos;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Category
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Set show_title
     *
     * @param boolean $showTitle
     * @return Category
     */
    public function setShowTitle($showTitle)
    {
        $this->show_title = $showTitle;
        return $this;
    }

    /**
     * Get show_title
     *
     * @return boolean 
     */
    public function getShowTitle()
    {
        return $this->show_title;
    }

    /**
     * Set depth
     *
     * @param integer $depth
     * @return Category
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
        return $this;
    }

    /**
     * Get depth
     *
     * @return integer 
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * Set pos
     *
     * @param integer $pos
     * @return Category
     */
    public function setPos($pos)
    {
        $this->pos = $pos;
        return $this;
    }

    /**
     * Get pos
     *
     * @return integer 
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * Set root_category_look
     *
     * @param string $rootCategoryLook
     * @return Category
     */
    public function setRootCategoryLook($rootCategoryLook)
    {
        $this->root_category_look = $rootCategoryLook;
        return $this;
    }

    /**
     * Get root_category_look
     *
     * @return string 
     */
    public function getRootCategoryLook()
    {
        return $this->root_category_look;
    }

    /**
     * Set cleanURL
     *
     * @param string $cleanURL
     * @return Category
     */
    public function setCleanURL($cleanURL)
    {
        $this->cleanURL = $cleanURL;
        return $this;
    }

    /**
     * Get cleanURL
     *
     * @return string 
     */
    public function getCleanURL()
    {
        return $this->cleanURL;
    }

    /**
     * Set quickFlags
     *
     * @param XLite\Model\Category\QuickFlags $quickFlags
     * @return Category
     */
    public function setQuickFlags(\XLite\Model\Category\QuickFlags $quickFlags = null)
    {
        $this->quickFlags = $quickFlags;
        return $this;
    }

    /**
     * Get quickFlags
     *
     * @return XLite\Model\Category\QuickFlags 
     */
    public function getQuickFlags()
    {
        return $this->quickFlags;
    }

    /**
     * Add memberships
     *
     * @param XLite\Model\Membership $memberships
     * @return Category
     */
    public function addMemberships(\XLite\Model\Membership $memberships)
    {
        $this->memberships[] = $memberships;
        return $this;
    }

    /**
     * Get memberships
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMemberships()
    {
        return $this->memberships;
    }

    /**
     * Get image
     *
     * @return XLite\Model\Image\Category\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add categoryProducts
     *
     * @param XLite\Model\CategoryProducts $categoryProducts
     * @return Category
     */
    public function addCategoryProducts(\XLite\Model\CategoryProducts $categoryProducts)
    {
        $this->categoryProducts[] = $categoryProducts;
        return $this;
    }

    /**
     * Get categoryProducts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCategoryProducts()
    {
        return $this->categoryProducts;
    }

    /**
     * Add children
     *
     * @param XLite\Model\Category $children
     * @return Category
     */
    public function addChildren(\XLite\Model\Category $children)
    {
        $this->children[] = $children;
        return $this;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Get parent
     *
     * @return XLite\Model\Category 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Translations (relation). AUTOGENERATED
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Model\CategoryTranslation", mappedBy="owner", cascade={"all"})
     */
    protected $translations;

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getName()
    {
        return $this->getSoftTranslation()->getName();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setName($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setName($value);
    }

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->getSoftTranslation()->getDescription();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setDescription($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setDescription($value);
    }

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getMetaTags()
    {
        return $this->getSoftTranslation()->getMetaTags();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setMetaTags($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setMetaTags($value);
    }

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getMetaDesc()
    {
        return $this->getSoftTranslation()->getMetaDesc();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setMetaDesc($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setMetaDesc($value);
    }

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->getSoftTranslation()->getMetaTitle();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setMetaTitle($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setMetaTitle($value);
    }


}