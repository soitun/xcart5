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
 * Module key
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\ModuleKey")
 * @Table  (name="module_keys",
 *      uniqueConstraints={
 *          @UniqueConstraint (name="an", columns={"author","name","xcnPlan"})
 *      },
 *      indexes={
 *          @Index (name="author_name", columns={"author","name","xcnPlan"})
 *      }
 * )
 */
class ModuleKey extends \XLite\Model\AEntity
{
    /**
     * Type of X-Cart 5 key license
     */
    const KEY_TYPE_XCN = 2;

    /**
     * Key id
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer")
     */
    protected $keyId;

    /**
     * Module name
     *
     * @var string
     *
     * @Column (type="string", length=64)
     */
    protected $name;

    /**
     * Author name
     *
     * @var string
     *
     * @Column (type="string", length=64)
     */
    protected $author;

    /**
     * Key value
     *
     * @var string
     *
     * @Column (type="fixedstring", length=64)
     */
    protected $keyValue;

    /**
     * Flag if the key is binded to batch or module.
     * 0 - it is a module license key
     * 1 - it is a batch  license key
     * 2 - it is a core   license key
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $keyType = 0;

    /**
     * Type of license if the keyType is KEY_TYPE_XCN (==2)
     * @TODO Check if it is needed
     *
     * @var integer
     *
     * @Column (type="bigint")
     */
    protected $xcnPlan = 0;

    /**
     * Module data
     *
     * @var array
     *
     * @Column (type="array")
     */
    protected $keyData = array();

    /**
     * Get keyId
     *
     * @return integer 
     */
    public function getKeyId()
    {
        return $this->keyId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ModuleKey
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
     * Set author
     *
     * @param string $author
     * @return ModuleKey
     */
    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set keyValue
     *
     * @param fixedstring $keyValue
     * @return ModuleKey
     */
    public function setKeyValue($keyValue)
    {
        $this->keyValue = $keyValue;
        return $this;
    }

    /**
     * Get keyValue
     *
     * @return fixedstring 
     */
    public function getKeyValue()
    {
        return $this->keyValue;
    }

    /**
     * Set keyType
     *
     * @param integer $keyType
     * @return ModuleKey
     */
    public function setKeyType($keyType)
    {
        $this->keyType = $keyType;
        return $this;
    }

    /**
     * Get keyType
     *
     * @return integer 
     */
    public function getKeyType()
    {
        return $this->keyType;
    }

    /**
     * Set xcnPlan
     *
     * @param bigint $xcnPlan
     * @return ModuleKey
     */
    public function setXcnPlan($xcnPlan)
    {
        $this->xcnPlan = $xcnPlan;
        return $this;
    }

    /**
     * Get xcnPlan
     *
     * @return bigint 
     */
    public function getXcnPlan()
    {
        return $this->xcnPlan;
    }

    /**
     * Set keyData
     *
     * @param array $keyData
     * @return ModuleKey
     */
    public function setKeyData($keyData)
    {
        $this->keyData = $keyData;
        return $this;
    }

    /**
     * Get keyData
     *
     * @return array 
     */
    public function getKeyData()
    {
        return $this->keyData;
    }
}