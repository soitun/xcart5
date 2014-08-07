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
 * Template patch
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\TemplatePatch")
 * @Table  (name="template_patches",
 *          indexes={
 *              @index(name="zlt", columns={"zone", "lang", "tpl"})
 *          }
 * )
 */
class TemplatePatch extends \XLite\Model\AEntity
{
    /**
     * Patch id
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer", length=11)
     */
    protected $patch_id;

    /**
     * Zone
     *
     * @var string
     *
     * @Column (type="string", length=16)
     */
    protected $zone = 'customer';

    /**
     * Language code
     *
     * @var string
     *
     * @Column (type="string", length=2)
     */
    protected $lang = '';

    /**
     * Template
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $tpl;

    /**
     * Patch type
     *
     * @var string
     *
     * @Column (type="string", length=8)
     */
    protected $patch_type = 'custom';

    /**
     * XPath query
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $xpath_query = '';

    /**
     * XPath insertaion type
     *
     * @var string
     *
     * @Column (type="string", length=16)
     */
    protected $xpath_insert_type = 'before';

    /**
     * XPath replacement block
     *
     * @var string
     *
     * @Column (type="text")
     */
    protected $xpath_block = '';

    /**
     * Regular expression patter
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $regexp_pattern = '';

    /**
     * Regular expression replacement block
     *
     * @var string
     *
     * @Column (type="text")
     */
    protected $regexp_replace = '';

    /**
     * Custom callback name
     *
     * @var string
     *
     * @Column (type="string", length=128)
     */
    protected $custom_callback = '';

    /**
     * Get patch_id
     *
     * @return integer 
     */
    public function getPatchId()
    {
        return $this->patch_id;
    }

    /**
     * Set zone
     *
     * @param string $zone
     * @return TemplatePatch
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
        return $this;
    }

    /**
     * Get zone
     *
     * @return string 
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * Set lang
     *
     * @param string $lang
     * @return TemplatePatch
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * Get lang
     *
     * @return string 
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set tpl
     *
     * @param string $tpl
     * @return TemplatePatch
     */
    public function setTpl($tpl)
    {
        $this->tpl = $tpl;
        return $this;
    }

    /**
     * Get tpl
     *
     * @return string 
     */
    public function getTpl()
    {
        return $this->tpl;
    }

    /**
     * Set patch_type
     *
     * @param string $patchType
     * @return TemplatePatch
     */
    public function setPatchType($patchType)
    {
        $this->patch_type = $patchType;
        return $this;
    }

    /**
     * Get patch_type
     *
     * @return string 
     */
    public function getPatchType()
    {
        return $this->patch_type;
    }

    /**
     * Set xpath_query
     *
     * @param string $xpathQuery
     * @return TemplatePatch
     */
    public function setXpathQuery($xpathQuery)
    {
        $this->xpath_query = $xpathQuery;
        return $this;
    }

    /**
     * Get xpath_query
     *
     * @return string 
     */
    public function getXpathQuery()
    {
        return $this->xpath_query;
    }

    /**
     * Set xpath_insert_type
     *
     * @param string $xpathInsertType
     * @return TemplatePatch
     */
    public function setXpathInsertType($xpathInsertType)
    {
        $this->xpath_insert_type = $xpathInsertType;
        return $this;
    }

    /**
     * Get xpath_insert_type
     *
     * @return string 
     */
    public function getXpathInsertType()
    {
        return $this->xpath_insert_type;
    }

    /**
     * Set xpath_block
     *
     * @param text $xpathBlock
     * @return TemplatePatch
     */
    public function setXpathBlock($xpathBlock)
    {
        $this->xpath_block = $xpathBlock;
        return $this;
    }

    /**
     * Get xpath_block
     *
     * @return text 
     */
    public function getXpathBlock()
    {
        return $this->xpath_block;
    }

    /**
     * Set regexp_pattern
     *
     * @param string $regexpPattern
     * @return TemplatePatch
     */
    public function setRegexpPattern($regexpPattern)
    {
        $this->regexp_pattern = $regexpPattern;
        return $this;
    }

    /**
     * Get regexp_pattern
     *
     * @return string 
     */
    public function getRegexpPattern()
    {
        return $this->regexp_pattern;
    }

    /**
     * Set regexp_replace
     *
     * @param text $regexpReplace
     * @return TemplatePatch
     */
    public function setRegexpReplace($regexpReplace)
    {
        $this->regexp_replace = $regexpReplace;
        return $this;
    }

    /**
     * Get regexp_replace
     *
     * @return text 
     */
    public function getRegexpReplace()
    {
        return $this->regexp_replace;
    }

    /**
     * Set custom_callback
     *
     * @param string $customCallback
     * @return TemplatePatch
     */
    public function setCustomCallback($customCallback)
    {
        $this->custom_callback = $customCallback;
        return $this;
    }

    /**
     * Get custom_callback
     *
     * @return string 
     */
    public function getCustomCallback()
    {
        return $this->custom_callback;
    }
}