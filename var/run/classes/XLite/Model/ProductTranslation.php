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
 * Product multilingual data
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Base\Translation")
 *
 * @Table (name="product_translations",
 *         indexes={
 *              @Index (name="ci", columns={"code","id"}),
 *              @Index (name="id", columns={"id"}),
 *              @Index (name="name", columns={"name"})
 *         }
 * )
 */
class ProductTranslation extends \XLite\Model\Base\Translation
{
    /**
     * Product name
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $name;

    /**
     * Product description
     *
     * @var string
     *
     * @Column (type="text")
     */
    protected $description = '';

    /**
     * Product brief description
     *
     * @var string
     *
     * @Column (type="text")
     */
    protected $briefDescription = '';

    /**
     * Meta tags
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $metaTags = '';

    /**
     * Product meta description
     *
     * @var string
     *
     * @Column (type="text")
     */
    protected $metaDesc = '';

    /**
     * Meta title
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $metaTitle = '';

    /**
     * Set name
     *
     * @param string $name
     * @return ProductTranslation
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param text $description
     * @return ProductTranslation
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set briefDescription
     *
     * @param text $briefDescription
     * @return ProductTranslation
     */
    public function setBriefDescription($briefDescription)
    {
        $this->briefDescription = $briefDescription;
        return $this;
    }

    /**
     * Get briefDescription
     *
     * @return text 
     */
    public function getBriefDescription()
    {
        return $this->briefDescription;
    }

    /**
     * Set metaTags
     *
     * @param string $metaTags
     * @return ProductTranslation
     */
    public function setMetaTags($metaTags)
    {
        $this->metaTags = $metaTags;
        return $this;
    }

    /**
     * Get metaTags
     *
     * @return string 
     */
    public function getMetaTags()
    {
        return $this->metaTags;
    }

    /**
     * Set metaDesc
     *
     * @param text $metaDesc
     * @return ProductTranslation
     */
    public function setMetaDesc($metaDesc)
    {
        $this->metaDesc = $metaDesc;
        return $this;
    }

    /**
     * Get metaDesc
     *
     * @return text 
     */
    public function getMetaDesc()
    {
        return $this->metaDesc;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return ProductTranslation
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string 
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Get label_id
     *
     * @return integer 
     */
    public function getLabelId()
    {
        return $this->label_id;
    }

    /**
     * Set code
     *
     * @param fixedstring $code
     * @return ProductTranslation
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get code
     *
     * @return fixedstring 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Translation owner (relation). AUTOGENERATED
     *
     * @var XLite\Model\Product
     *
     * @ManyToOne  (targetEntity="XLite\Model\Product", inversedBy="translations")
     * @JoinColumn (name="id", referencedColumnName="product_id")
     */
    protected $owner;


}