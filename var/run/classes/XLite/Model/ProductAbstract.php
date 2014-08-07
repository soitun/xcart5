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

namespace XLite\Model;

/**
 * @HasLifecycleCallbacks
 * @MappedSuperClass (repositoryClass="\XLite\Model\Repo\Product")
 */
abstract class ProductAbstract extends \XLite\Model\Base\Catalog implements \XLite\Model\Base\IOrderItem
{
    /**
     * Product unique ID
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="uinteger")
     */
    protected $product_id;

    /**
     * Product price
     *
     * @var float
     *
     * @Column (
     *      type="money",
     *      options={
     *          @\XLite\Core\Doctrine\Annotation\Behavior (list={"taxable"}),
     *          @\XLite\Core\Doctrine\Annotation\Purpose (name="net", source="clear"),
     *          @\XLite\Core\Doctrine\Annotation\Purpose (name="display", source="net")
     *      }
     *  )
     */
    protected $price = 0.0000;

    /**
     * Product SKU
     *
     * @var string
     *
     * @Column (type="string", length=32, nullable=true)
     */
    protected $sku;

    /**
     * Is product available or not
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $enabled = true;

    /**
     * Product weight
     *
     * @var float
     *
     * @Column (type="decimal", precision=14, scale=4)
     */
    protected $weight = 0.0000;

    /**
     * Is product shipped in separate box
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $useSeparateBox = false;

    /**
     * Product box width
     *
     * @var float
     *
     * @Column (type="decimal", precision=14, scale=4)
     */
    protected $boxWidth = 0.0000;

    /**
     * Product box length
     *
     * @var float
     *
     * @Column (type="decimal", precision=14, scale=4)
     */
    protected $boxLength = 0.0000;

    /**
     * Product box height
     *
     * @var float
     *
     * @Column (type="decimal", precision=14, scale=4)
     */
    protected $boxHeight = 0.0000;

    /**
     * How many product items can be placed in a box
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $itemsPerBox = 1;

    /**
     * Is free shipping available for the product
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $free_shipping = false;

    /**
     * If false then the product is free from any taxes
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $taxable = true;

    /**
     * Custom javascript code
     *
     * @var string
     *
     * @Column (type="text")
     */
    protected $javascript = '';

    /**
     * Arrival date (UNIX timestamp)
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $arrivalDate = 0;

    /**
     * Creation date (UNIX timestamp)
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $date = 0;

    /**
     * Update date (UNIX timestamp)
     *
     * @var integer
     *
     * @Column (type="uinteger")
     */
    protected $updateDate = 0;

    /**
     * Relation to a CategoryProducts entities
     *
     * @var \Doctrine\ORM\PersistentCollection
     *
     * @OneToMany (targetEntity="XLite\Model\CategoryProducts", mappedBy="product", cascade={"all"})
     * @OrderBy   ({"orderby" = "ASC"})
     */
    protected $categoryProducts;

    /**
     * Product order items
     *
     * @var \XLite\Model\OrderItem
     *
     * @OneToMany (targetEntity="XLite\Model\OrderItem", mappedBy="object")
     */
    protected $order_items;

    /**
     * Product images
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Model\Image\Product\Image", mappedBy="product", cascade={"all"})
     * @OrderBy   ({"orderby" = "ASC"})
     */
    protected $images;

    /**
     * Qty in stock
     *
     * @var \XLite\Model\Inventory
     *
     * @OneToOne (targetEntity="XLite\Model\Inventory", mappedBy="product", fetch="LAZY", cascade={"all"})
     */
    protected $inventory;

    /**
     * Product class (relation)
     *
     * @var \XLite\Model\ProductClass
     *
     * @ManyToOne  (targetEntity="XLite\Model\ProductClass")
     * @JoinColumn (name="product_class_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $productClass;

    /**
     * Tax class (relation)
     *
     * @var \XLite\Model\TaxClass
     *
     * @ManyToOne  (targetEntity="XLite\Model\TaxClass")
     * @JoinColumn (name="tax_class_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $taxClass;

    /**
     * Attributes
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Model\Attribute", mappedBy="product", cascade={"all"})
     * @OrderBy   ({"position" = "ASC"})
     */
    protected $attributes;

    /**
     * Attribute value (checkbox)
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Model\AttributeValue\AttributeValueCheckbox", mappedBy="product", cascade={"all"})
     */
    protected $attributeValueC;

    /**
     * Attribute value (text)
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Model\AttributeValue\AttributeValueText", mappedBy="product", cascade={"all"})
     */
    protected $attributeValueT;

    /**
     * Attribute value (select)
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Model\AttributeValue\AttributeValueSelect", mappedBy="product", cascade={"all"})
     */
    protected $attributeValueS;

    /**
     * Show product attributes in a separate tab
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $attrSepTab = true;

    /**
     * How much product is sold (used in Top selling products statistics)
     *
     * @var integer
     */
    protected $sold = 0;

    /**
     * Quick data
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Model\QuickData", mappedBy="product", cascade={"all"})
     */
    protected $quickData;

    /**
     * Storage of current attribute values according to the clear price will be calculated
     *
     * @var array
     */
    protected $attrValues = array();

    /**
     * Memberships
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ManyToMany (targetEntity="XLite\Model\Membership", inversedBy="products")
     * @JoinTable (name="product_membership_links",
     *      joinColumns={@JoinColumn(name="product_id", referencedColumnName="product_id")},
     *      inverseJoinColumns={@JoinColumn(name="membership_id", referencedColumnName="membership_id")}
     * )
     */
    protected $memberships;

    /**
     * Clone
     *
     * @return \XLite\Model\AEntity
     */
    public function cloneEntity()
    {
        $newProduct = parent::cloneEntity();

        $this->cloneEntityScalar($newProduct);

        if (!$newProduct->update(true) || !$newProduct->getProductId()) {
            \XLite::getInstance()->doGlobalDie('Can not clone product');
        }

        $this->cloneEntityModels($newProduct);
        $this->cloneEntityCategories($newProduct);
        $this->cloneEntityAttributes($newProduct);
        $this->cloneEntityImages($newProduct);
        $this->cloneEntityInventory($newProduct);

        $newProduct->update(true);

        return $newProduct;
    }

    /**
     * Clone entity (scalar fields)
     *
     * @param \XLite\Model\Product $newProduct New product
     *
     * @return void
     */
    protected function cloneEntityScalar(\XLite\Model\Product $newProduct)
    {
        $newProduct->setSku(\XLite\Core\Database::getRepo('XLite\Model\Product')->assembleUniqueSKU($this->getSku()));
        $newProduct->setName($this->getCloneName($this->getName()));

        if ($this->getCleanURL()) {
            $newProduct->setCleanURL(\XLite\Core\Database::getRepo('XLite\Model\Product')->generateCleanURL($newProduct));
        }
    }

    /**
     * Clone entity (model fields)
     *
     * @param \XLite\Model\Product $newProduct New product
     *
     * @return void
     */
    protected function cloneEntityModels(\XLite\Model\Product $newProduct)
    {

        $newProduct->setTaxClass($this->getTaxClass());
        $newProduct->setProductClass($this->getProductClass());
    }

    /**
     * Clone entity (categories)
     *
     * @param \XLite\Model\Product $newProduct New product
     *
     * @return void
     */
    protected function cloneEntityCategories(\XLite\Model\Product $newProduct)
    {
        foreach ($this->getCategories() as $category) {
            $link = new \XLite\Model\CategoryProducts;
            $link->setProduct($newProduct);
            $link->setCategory($category);
            $newProduct->addCategoryProducts($link);
            \XLite\Core\Database::getEM()->persist($link);
        }
    }

    /**
     * Clone entity (attributes)
     *
     * @param \XLite\Model\Product $newProduct New product
     *
     * @return void
     */
    protected function cloneEntityAttributes(\XLite\Model\Product $newProduct)
    {
        foreach (\XLite\Model\Attribute::getTypes() as $type => $name) {
            $methodGet = 'getAttributeValue' . $type;
            $methodAdd = 'addAttributeValue' . $type;
            foreach ($this->$methodGet() as $value) {
                if (!$value->getAttribute()->getProduct()) {
                    $newValue = $value->cloneEntity();
                    $newValue->setProduct($newProduct);
                    $newProduct->$methodAdd($newValue);
                    \XLite\Core\Database::getEM()->persist($newValue);
                }
            }
        }

        foreach ($this->getAttributes() as $attribute) {
            $class = $attribute->getAttributeValueClass($attribute->getType());
            $repo = \XLite\Core\Database::getRepo($class);
            $methodAdd = 'addAttributeValue' . $attribute->getType();
            $newAttribute = $attribute->cloneEntity();
            $newAttribute->setProduct($newProduct);
            $newProduct->addAttributes($newAttribute);
            \XLite\Core\Database::getEM()->persist($newAttribute);
            foreach ($repo->findBy(array('attribute' => $attribute, 'product' => $this)) as $value) {
                $newValue = $value->cloneEntity();
                $newValue->setProduct($newProduct);
                $newValue->setAttribute($newAttribute);
                $newProduct->$methodAdd($newValue);
                \XLite\Core\Database::getEM()->persist($newValue);
            }
        }
    }

    /**
     * Clone entity (images)
     *
     * @param \XLite\Model\Product $newProduct New product
     *
     * @return void
     */
    protected function cloneEntityImages(\XLite\Model\Product $newProduct)
    {
        foreach ($this->getImages() as $image) {
            $newImage = $image->cloneEntity();
            $newImage->setProduct($newProduct);
            $newProduct->addImages($newImage);
        }
    }

    /**
     * Clone entity (inventory)
     *
     * @param \XLite\Model\Product $newProduct New product
     *
     * @return void
     */
    protected function cloneEntityInventory(\XLite\Model\Product $newProduct)
    {
        $inventory = $this->getInventory()->cloneEntity();
        $newProduct->setInventory($inventory);
        $inventory->setProduct($newProduct);
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
        $this->images           = new \Doctrine\Common\Collections\ArrayCollection();
        $this->order_items      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->memberships      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attributeValueC  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attributeValueS  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attributeValueT  = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attributes       = new \Doctrine\Common\Collections\ArrayCollection();
        $this->quickData        = new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct($data);
    }

    /**
     * Get object unique id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->getProductId();
    }

    /**
     * Get weight
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Get price: modules should never overwrite this method
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Get clear price: this price can be overwritten by modules
     *
     * @return float
     */
    public function getClearPrice()
    {
        return $this->getPrice();
    }

    /**
     * Get quick data price
     *
     * @return float
     */
    public function getQuickDataPrice()
    {
        $price = $this->getClearPrice();

        foreach ($this->prepareAttributeValues() as $av) {
            if (is_object($av)) {
                $price += $av->getAbsoluteValue('price');
            }
        }

        return $price;
    }

    /**
     * Get clear weight
     *
     * @return float
     */
    public function getClearWeight()
    {
        return $this->getWeight();
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getSoftTranslation()->getName();
    }

    /**
     * Get SKU
     *
     * @return string
     */
    public function getSku()
    {
        return isset($this->sku) ? strval($this->sku) : null;
    }

    /**
     * Get quantity of the product
     *
     * @return integer
     */
    public function getQty()
    {
        return $this->getInventory()->getAmount();
    }

    /**
     * Get image
     *
     * @return \XLite\Model\Image\Product\Image
     */
    public function getImage()
    {
        return $this->getImages()->get(0);
    }

    /**
     * Get free shipping flag
     *
     * @return boolean
     */
    public function getFreeShipping()
    {
        return $this->free_shipping;
    }

    /**
     * Get shippable flag
     *
     * @return boolean
     */
    public function getShippable()
    {
        return !$this->getFreeShipping();
    }

    /**
     * Set shippable flag
     *
     * @param boolean $value Value
     *
     * @return void
     */
    public function setShippable($value)
    {
        return $this->setFreeShipping(!$value);
    }

    /**
     * Check if product is accessible
     *
     * @return boolean
     */
    public function isAvailable()
    {
        return \XLite::isAdminZone() || $this->isPublicAvailable();
    }

    /**
     * Check prodyct availability for public usage (customer interface)
     *
     * @return boolean
     */
    public function isPublicAvailable()
    {
        return $this->isVisible()
            && $this->availableInDate()
            && !$this->isOutOfStock();
    }

    /**
     * Check product visibility
     *
     * @return boolean
     */
    public function isVisible()
    {
        return $this->getEnabled()
            && $this->hasAvailableMembership();
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
     * Flag if the product is available according date/time
     *
     * @return boolean
     */
    public function availableInDate()
    {
        return !$this->getArrivalDate()
            || static::getUserTime() > $this->getArrivalDate();
    }

    /**
     * Check if product has image or not
     *
     * @return boolean
     */
    public function hasImage()
    {
        return !is_null($this->getImage()) && $this->getImage()->isPersistent();
    }

    /**
     * Return image URL
     *
     * @return string|void
     */
    public function getImageURL()
    {
        return $this->getImage() ? $this->getImage()->getURL() : null;
    }

    /**
     * Return random product category
     *
     * @param integer|null $categoryId Category ID OPTIONAL
     *
     * @return \XLite\Model\Category
     */
    public function getCategory($categoryId = null)
    {
        $result = $this->getLink($categoryId)->getCategory();

        if (empty($result)) {
            $result = new \XLite\Model\Category();
        }

        return $result;
    }

    /**
     * Return random product category ID
     *
     * @param integer|null $categoryId Category ID OPTIONAL
     *
     * @return integer
     */
    public function getCategoryId($categoryId = null)
    {
        return $this->getCategory($categoryId)->getCategoryId();
    }

    /**
     * Return list of product categories
     *
     * @return \Doctrine\ORM\PersistentCollection
     */
    public function getCategories()
    {
        return \XLite\Core\Database::getRepo('\XLite\Model\Category')->findAllByProductId($this->getProductId());
    }

    /**
     * Setter
     *
     * @param double $value Value to set
     *
     * @return void
     */
    public function setAmount($value)
    {
        $this->getInventory()->setAmount($value);
    }

    /**
     * Get product Url
     *
     * @return string
     */
    public function getURL()
    {
        return $this->getProductId()
            ? \XLite\Core\Converter::buildURL('product', '', array('product_id' => $this->getProductId()))
            : null;
    }

    /**
     * Get front URL
     *
     * @return string
     */
    public function getFrontURL()
    {
        return $this->getProductId()
            ? \XLite::getInstance()->getShopURL(
                \XLite\Core\Converter::buildURL('product', '', array('product_id' => $this->getProductId()), \XLite::CART_SELF)
            )
            : null;
    }

    /**
     * Minimal available amount
     *
     * @return integer
     */
    public function getMinPurchaseLimit()
    {
        return 1;
    }

    /**
     * Maximal available amount
     *
     * @return integer
     */
    public function getMaxPurchaseLimit()
    {
        return intval(\XLite\Core\Config::getInstance()->General->default_purchase_limit);
    }

    /**
     * Get inventory
     *
     * @return \XLite\Model\Inventory
     */
    public function getInventory()
    {
        if (isset($this->inventory)) {
            $inventory = $this->inventory;

        } else {
            $inventory = new \XLite\Model\Inventory();
            $inventory->setProduct($this);

        }

        return $inventory;
    }

    /**
     * Return product amount available to add to cart
     *
     * @return integer
     */
    public function getAvailableAmount()
    {
        return $this->getInventory()->getAvailableAmount();
    }

    /**
     * Alias: is product in stock or not
     *
     * @return boolean
     */
    public function isOutOfStock()
    {
        return $this->getInventory()->isOutOfStock();
    }

    /**
     * Return product position in category
     *
     * @param integer|null $categoryId Category ID OPTIONAL
     *
     * @return integer|void
     */
    public function getOrderBy($categoryId = null)
    {
        $link = $this->getLink($categoryId);

        return $link ? $link->getOrderBy() : null;
    }

    /**
     * Count product images
     *
     * @return integer
     */
    public function countImages()
    {
        return count($this->getImages());
    }

    /**
     * Try to fetch product description
     *
     * @return string
     */
    public function getCommonDescription()
    {
        return $this->getBriefDescription() ?: $this->getDescription();
    }

    /**
     * Get taxable basis
     *
     * @return float
     */
    public function getTaxableBasis()
    {
        return $this->getNetPrice();
    }

    /**
     * Prepare creation date
     *
     * @return void
     *
     * @PrePersist
     */
    public function prepareBeforeCreate()
    {
        $time = \XLite\Core\Converter::time();

        if (!$this->getDate()) {
            $this->setDate($time);
        }

        if (!$this->getArrivalDate()) {
            $this->setArrivalDate(mktime(0, 0, 0, date('m', $time), date('j', $time), date('Y', $time)));
        }

        $this->prepareBeforeUpdate();
    }

    /**
     * Prepare update date
     *
     * @return void
     *
     * @PreUpdate
     */
    public function prepareBeforeUpdate()
    {
        $this->setUpdateDate(\XLite\Core\Converter::time());

        if (\XLite\Core\Converter::isEmptyString($this->getSKU())) {
            $this->setSKU(null);
        }
    }

    /**
     * Prepare remove
     *
     * @return void
     *
     * @PreRemove
     */
    public function prepareBeforeRemove()
    {
        // No default actions. May be used in modules
    }

    /**
     * Set product class
     *
     * @param XLite\Model\ProductClass $productClass Product class
     *
     * @return \XLite\Model\Product
     */
    public function setProductClass(\XLite\Model\ProductClass $productClass = null)
    {
        if (
            $this->productClass
            && (
                !$productClass
                || $productClass->getId() != $this->productClass->getId()
            )
        ) {
            $this->preprocessChangeProductClass();
        }

        $this->productClass = $productClass;

        return $this;
    }

    /**
     * Get attr values
     *
     * @return array
     */
    public function getAttrValues()
    {
        return $this->attrValues;
    }

    /**
     * Set attr values
     *
     * @return void
     */
    public function setAttrValues($value)
    {
        $this->attrValues = $value;
    }

    /**
     * Sort editable attributes
     *
     * @param array $a Attribute A
     * @param array $b Attribute B
     *
     * @return boolean
     */
    protected function sortEditableAttributes($a, $b)
    {
        return $a['position'] >= $b['position'];
    }

    /**
     * Get editable attributes
     *
     * @return array
     */
    public function getEditableAttributes()
    {
        $result = array();

        foreach (\XLite\Model\Attribute::getTypes() as $type => $name) {
            $class = \XLite\Model\Attribute::getAttributeValueClass($type);
            if (is_subclass_of($class, 'XLite\Model\AttributeValue\Multiple')) {
                $result = array_merge(
                    $result,
                    \XLite\Core\Database::getRepo($class)->findMultipleAttributes($this)
                );

            } elseif ('\XLite\Model\AttributeValue\AttributeValueText' == $class) {
                $result = array_merge(
                    $result,
                    \XLite\Core\Database::getRepo($class)->findEditableAttributes($this)
                );
            }
        }

        usort($result, array($this, 'sortEditableAttributes'));

        if ($result) {
            foreach ($result as $k => $v) {
                $result[$k] = $v[0];
            }
        }

        return $result;
    }

    /**
     * Get editable attributes ids
     *
     * @return array
     */
    public function getEditableAttributesIds()
    {
        $result = array();

        foreach ($this->getEditableAttributes() as $a) {
            $result[] = $a->getId();
        }
        sort($result);

        return $result;
    }

    /**
     * Check - product has editable attrbiutes or not
     *
     * @return boolean
     */
    public function hasEditableAttributes()
    {
        return 0 < count($this->getEditableAttributes());
    }

    /**
     * Get multiple attributes
     *
     * @return array
     */
    public function getMultipleAttributes()
    {
        $result = array();

        foreach (\XLite\Model\Attribute::getTypes() as $type => $name) {
            $class = \XLite\Model\Attribute::getAttributeValueClass($type);
            if (is_subclass_of($class, 'XLite\Model\AttributeValue\Multiple')) {
                $result = array_merge(
                    $result,
                    \XLite\Core\Database::getRepo($class)->findMultipleAttributes($this)
                );
            }
        }

        if ($result) {
            foreach ($result as $k => $v) {
                $result[$k] = $v[0];
            }
        }

        return $result;
    }

    /**
     * Get multiple attributes ids
     *
     * @return array
     */
    public function getMultipleAttributesIds()
    {
        $result = array();

        foreach ($this->getMultipleAttributes() as $a) {
            $result[] = $a->getId();
        }
        sort($result);

        return $result;
    }

    /**
     * Check - product has multiple attrbiutes or not
     *
     * @return boolean
     */
    public function hasMultipleAttributes()
    {
        return 0 < count($this->getMultipleAttributes());
    }

    /**
     * Update quick data
     *
     * @return void
     */
    public function updateQuickData()
    {
        if ($this->isPersistent()) {
            \XLite\Core\QuickData::getInstance()->updateProductData($this);
        }
    }

    /**
     * Prepare attribute values
     *
     * @param array $ids Request-based selected attribute values OPTIONAL
     *
     * @return array
     */
    public function prepareAttributeValues($ids = array())
    {
        $attributeValues = array();
        foreach ($this->getEditableAttributes() as $a) {
            if ($a->getType() == \XLite\Model\Attribute::TYPE_TEXT) {
                $attributeValues[$a->getId()] = array(
                    'attributeValue' => $a->getAttributeValue($this),
                    'value'          => isset($ids[$a->getId()]) ? $ids[$a->getId()] : $a->getAttributeValue($this)->getValue(),
                );

            } else {
                $attributeValues[$a->getId()] = $a->getDefaultAttributeValue($this);
                if (isset($ids[$a->getId()])) {
                    foreach ($a->getAttributeValue($this) as $av) {
                        if ($av->getId() == $ids[$a->getId()]) {
                            $attributeValues[$a->getId()] = $av;
                            break;
                        }
                    }
                }
            }
        }

        return $attributeValues;
    }

    /**
     * Define the specific clone name for the product
     *
     * @param string $name Product name
     *
     * @return string
     */
    protected function getCloneName($name)
    {
        return $name . ' [ clone ]';
    }

    /**
     * Preprocess change product class
     *
     * @return void
     */
    protected function preprocessChangeProductClass()
    {
        if ($this->productClass) {
            foreach ($this->productClass->getAttributes() as $a) {
                $class = $a->getAttributeValueClass($a->getType());
                $repo = \XLite\Core\Database::getRepo($class);
                foreach ($repo->findBy(array('product' => $this, 'attribute' => $a)) as $v) {
                    $repo->delete($v);
                }
            }
        }
    }

    /**
     * Return certain Product <--> Category association
     *
     * @param integer|null $categoryId Category ID
     *
     * @return \XLite\Model\CategoryProducts|void
     */
    protected function findLinkByCategoryId($categoryId)
    {
        $result = null;

        foreach ($this->getCategoryProducts() as $cp) {
            if ($cp->getCategory() && $cp->getCategory()->getCategoryId() == $categoryId) {
                $result = $cp;
            }
        }

        return $result;
    }

    /**
     * Return certain Product <--> Category association
     *
     * @param integer|null $categoryId Category ID OPTIONAL
     *
     * @return \XLite\Model\CategoryProducts
     */
    protected function getLink($categoryId = null)
    {
        $result = empty($categoryId)
            ? $this->getCategoryProducts()->first()
            : $this->findLinkByCategoryId($categoryId);

        if (empty($result)) {
            $result = new \XLite\Model\CategoryProducts();
        }

        return $result;
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
     * Returns position of the product in the given category
     *
     * @param integer $category
     *
     * @return integer
     */
    public function getPosition($category)
    {
        return $this->getOrderBy($category);
    }

    /**
     * Sets the position of the product in the given category
     *
     * @param array $value
     *
     * @return void
     */
    public function setPosition($value)
    {
        $link = $this->getLink($value['category']);
        $link->setProduct($this);
        $link->setOrderby($value['position']);

        \XLite\Core\Database::getEM()->flush($link);
    }

    /**
     * Get product_id
     *
     * @return uinteger 
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set price
     *
     * @param money $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Set sku
     *
     * @param string $sku
     * @return Product
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Product
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
     * Set weight
     *
     * @param decimal $weight
     * @return Product
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * Set useSeparateBox
     *
     * @param boolean $useSeparateBox
     * @return Product
     */
    public function setUseSeparateBox($useSeparateBox)
    {
        $this->useSeparateBox = $useSeparateBox;
        return $this;
    }

    /**
     * Get useSeparateBox
     *
     * @return boolean 
     */
    public function getUseSeparateBox()
    {
        return $this->useSeparateBox;
    }

    /**
     * Set boxWidth
     *
     * @param decimal $boxWidth
     * @return Product
     */
    public function setBoxWidth($boxWidth)
    {
        $this->boxWidth = $boxWidth;
        return $this;
    }

    /**
     * Get boxWidth
     *
     * @return decimal 
     */
    public function getBoxWidth()
    {
        return $this->boxWidth;
    }

    /**
     * Set boxLength
     *
     * @param decimal $boxLength
     * @return Product
     */
    public function setBoxLength($boxLength)
    {
        $this->boxLength = $boxLength;
        return $this;
    }

    /**
     * Get boxLength
     *
     * @return decimal 
     */
    public function getBoxLength()
    {
        return $this->boxLength;
    }

    /**
     * Set boxHeight
     *
     * @param decimal $boxHeight
     * @return Product
     */
    public function setBoxHeight($boxHeight)
    {
        $this->boxHeight = $boxHeight;
        return $this;
    }

    /**
     * Get boxHeight
     *
     * @return decimal 
     */
    public function getBoxHeight()
    {
        return $this->boxHeight;
    }

    /**
     * Set itemsPerBox
     *
     * @param integer $itemsPerBox
     * @return Product
     */
    public function setItemsPerBox($itemsPerBox)
    {
        $this->itemsPerBox = $itemsPerBox;
        return $this;
    }

    /**
     * Get itemsPerBox
     *
     * @return integer 
     */
    public function getItemsPerBox()
    {
        return $this->itemsPerBox;
    }

    /**
     * Set free_shipping
     *
     * @param boolean $freeShipping
     * @return Product
     */
    public function setFreeShipping($freeShipping)
    {
        $this->free_shipping = $freeShipping;
        return $this;
    }

    /**
     * Set taxable
     *
     * @param boolean $taxable
     * @return Product
     */
    public function setTaxable($taxable)
    {
        $this->taxable = $taxable;
        return $this;
    }

    /**
     * Get taxable
     *
     * @return boolean 
     */
    public function getTaxable()
    {
        return $this->taxable;
    }

    /**
     * Set javascript
     *
     * @param text $javascript
     * @return Product
     */
    public function setJavascript($javascript)
    {
        $this->javascript = $javascript;
        return $this;
    }

    /**
     * Get javascript
     *
     * @return text 
     */
    public function getJavascript()
    {
        return $this->javascript;
    }

    /**
     * Set arrivalDate
     *
     * @param integer $arrivalDate
     * @return Product
     */
    public function setArrivalDate($arrivalDate)
    {
        $this->arrivalDate = $arrivalDate;
        return $this;
    }

    /**
     * Get arrivalDate
     *
     * @return integer 
     */
    public function getArrivalDate()
    {
        return $this->arrivalDate;
    }

    /**
     * Set date
     *
     * @param integer $date
     * @return Product
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return integer 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set updateDate
     *
     * @param uinteger $updateDate
     * @return Product
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;
        return $this;
    }

    /**
     * Get updateDate
     *
     * @return uinteger 
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set attrSepTab
     *
     * @param boolean $attrSepTab
     * @return Product
     */
    public function setAttrSepTab($attrSepTab)
    {
        $this->attrSepTab = $attrSepTab;
        return $this;
    }

    /**
     * Get attrSepTab
     *
     * @return boolean 
     */
    public function getAttrSepTab()
    {
        return $this->attrSepTab;
    }

    /**
     * Set cleanURL
     *
     * @param string $cleanURL
     * @return Product
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
     * Add categoryProducts
     *
     * @param XLite\Model\CategoryProducts $categoryProducts
     * @return Product
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
     * Add order_items
     *
     * @param XLite\Model\OrderItem $orderItems
     * @return Product
     */
    public function addOrderItems(\XLite\Model\OrderItem $orderItems)
    {
        $this->order_items[] = $orderItems;
        return $this;
    }

    /**
     * Get order_items
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrderItems()
    {
        return $this->order_items;
    }

    /**
     * Add images
     *
     * @param XLite\Model\Image\Product\Image $images
     * @return Product
     */
    public function addImages(\XLite\Model\Image\Product\Image $images)
    {
        $this->images[] = $images;
        return $this;
    }

    /**
     * Get images
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set inventory
     *
     * @param XLite\Model\Inventory $inventory
     * @return Product
     */
    public function setInventory(\XLite\Model\Inventory $inventory = null)
    {
        $this->inventory = $inventory;
        return $this;
    }

    /**
     * Get productClass
     *
     * @return XLite\Model\ProductClass 
     */
    public function getProductClass()
    {
        return $this->productClass;
    }

    /**
     * Set taxClass
     *
     * @param XLite\Model\TaxClass $taxClass
     * @return Product
     */
    public function setTaxClass(\XLite\Model\TaxClass $taxClass = null)
    {
        $this->taxClass = $taxClass;
        return $this;
    }

    /**
     * Get taxClass
     *
     * @return XLite\Model\TaxClass 
     */
    public function getTaxClass()
    {
        return $this->taxClass;
    }

    /**
     * Add attributes
     *
     * @param XLite\Model\Attribute $attributes
     * @return Product
     */
    public function addAttributes(\XLite\Model\Attribute $attributes)
    {
        $this->attributes[] = $attributes;
        return $this;
    }

    /**
     * Get attributes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Add attributeValueC
     *
     * @param XLite\Model\AttributeValue\AttributeValueCheckbox $attributeValueC
     * @return Product
     */
    public function addAttributeValueC(\XLite\Model\AttributeValue\AttributeValueCheckbox $attributeValueC)
    {
        $this->attributeValueC[] = $attributeValueC;
        return $this;
    }

    /**
     * Get attributeValueC
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAttributeValueC()
    {
        return $this->attributeValueC;
    }

    /**
     * Add attributeValueT
     *
     * @param XLite\Model\AttributeValue\AttributeValueText $attributeValueT
     * @return Product
     */
    public function addAttributeValueT(\XLite\Model\AttributeValue\AttributeValueText $attributeValueT)
    {
        $this->attributeValueT[] = $attributeValueT;
        return $this;
    }

    /**
     * Get attributeValueT
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAttributeValueT()
    {
        return $this->attributeValueT;
    }

    /**
     * Add attributeValueS
     *
     * @param XLite\Model\AttributeValue\AttributeValueSelect $attributeValueS
     * @return Product
     */
    public function addAttributeValueS(\XLite\Model\AttributeValue\AttributeValueSelect $attributeValueS)
    {
        $this->attributeValueS[] = $attributeValueS;
        return $this;
    }

    /**
     * Get attributeValueS
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAttributeValueS()
    {
        return $this->attributeValueS;
    }

    /**
     * Add quickData
     *
     * @param XLite\Model\QuickData $quickData
     * @return Product
     */
    public function addQuickData(\XLite\Model\QuickData $quickData)
    {
        $this->quickData[] = $quickData;
        return $this;
    }

    /**
     * Get quickData
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getQuickData()
    {
        return $this->quickData;
    }

    /**
     * Add memberships
     *
     * @param XLite\Model\Membership $memberships
     * @return Product
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
     * Translations (relation). AUTOGENERATED
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Model\ProductTranslation", mappedBy="owner", cascade={"all"})
     */
    protected $translations;

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
    public function getBriefDescription()
    {
        return $this->getSoftTranslation()->getBriefDescription();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setBriefDescription($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setBriefDescription($value);
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



    /**
     * Get net Price
     *
     * @return float
     */
    public function getNetPrice()
    {
        return \XLite\Logic\Price::getInstance()->apply($this, 'getClearPrice', array('taxable'), 'net');
    }

    /**
     * Get display Price
     *
     * @return float
     */
    public function getDisplayPrice()
    {
        return \XLite\Logic\Price::getInstance()->apply($this, 'getNetPrice', array('taxable'), 'display');
    }


}