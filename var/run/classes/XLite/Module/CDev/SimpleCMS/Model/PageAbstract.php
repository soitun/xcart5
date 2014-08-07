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

namespace XLite\Module\CDev\SimpleCMS\Model;

/**
 * @MappedSuperClass (repositoryClass="\XLite\Module\CDev\SimpleCMS\Model\Repo\Page")
 */
abstract class PageAbstract extends \XLite\Model\Base\Catalog
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
    protected $id;

    /**
     * Is menu enabled or not
     *
     * @var   boolean
     *
     * @Column (type="boolean")
     */
    protected $enabled = true;

    /**
     * One-to-one relation with page_images table
     *
     * @var   \XLite\Module\CDev\SimpleCMS\Model\Image\Page\Image
     *
     * @OneToOne  (targetEntity="XLite\Module\CDev\SimpleCMS\Model\Image\Page\Image", mappedBy="page", cascade={"all"})
     */
    protected $image;

    /**
     * Get front URL
     *
     * @return string
     */
    public function getFrontURL()
    {
        return $this->getId()
            ? \XLite::getInstance()->getShopURL(\XLite\Core\Converter::buildURL('page', '', array('id' => $this->getId()), 'cart.php', true))
            : null;
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
     * Get id
     *
     * @return uinteger 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Page
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
     * Set cleanURL
     *
     * @param string $cleanURL
     * @return Page
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
     * Set image
     *
     * @param XLite\Module\CDev\SimpleCMS\Model\Image\Page\Image $image
     * @return Page
     */
    public function setImage(\XLite\Module\CDev\SimpleCMS\Model\Image\Page\Image $image = null)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Get image
     *
     * @return XLite\Module\CDev\SimpleCMS\Model\Image\Page\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Translations (relation). AUTOGENERATED
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Module\CDev\SimpleCMS\Model\PageTranslation", mappedBy="owner", cascade={"all"})
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
    public function getTeaser()
    {
        return $this->getSoftTranslation()->getTeaser();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setTeaser($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setTeaser($value);
    }

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getBody()
    {
        return $this->getSoftTranslation()->getBody();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setBody($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setBody($value);
    }

    /**
     * Translation getter. AUTOGENERATED
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->getSoftTranslation()->getMetaKeywords();
    }

    /**
     * Translation setter. AUTOGENERATED
     *
     * @param string $value value to set
     *
     * @return void
     */
    public function setMetaKeywords($value)
    {
        $translation = $this->getTranslation();

        if (!$this->hasTranslation($translation->getCode())) {
            $this->addTranslations($translation);
        }

        return $translation->setMetaKeywords($value);
    }


}