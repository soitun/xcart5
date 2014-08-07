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
 * View list
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\ViewList")
 * @Table  (name="view_lists",
 *          indexes={
 *              @Index (name="tl", columns={"tpl", "list"}),
 *              @Index (name="lz", columns={"list", "zone"})
 *          }
 * )
 */
class ViewList extends \XLite\Model\AEntity
{
    /**
     * Predefined weights
     */
    const POSITION_FIRST = 0;
    const POSITION_LAST  = 16777215;

    /**
     * Predefined interfaces
     */
    const INTERFACE_CUSTOMER = 'customer';
    const INTERFACE_ADMIN    = 'admin';
    const INTERFACE_CONSOLE  = 'console';
    const INTERFACE_MAIL     = 'mail';

    /**
     * List id
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer", length=11)
     */
    protected $list_id;

    /**
     * Class name
     *
     * @var string
     *
     * @Column (type="string")
     */
    protected $class = '';

    /**
     * Class list name
     *
     * @var string
     *
     * @Column (type="string")
     */
    protected $list;

    /**
     * List interface
     *
     * @var string
     *
     * @Column (type="string", length=16)
     */
    protected $zone = self::INTERFACE_CUSTOMER;

    /**
     * Child class name
     *
     * @var string
     *
     * @Column (type="string", length=512)
     */
    protected $child = '';

    /**
     * Child weight
     *
     * @var integer
     *
     * @Column (type="integer", length=11)
     */
    protected $weight = 0;

    /**
     * Template relative path
     *
     * @var string
     *
     * @Column (type="string", length=512)
     */
    protected $tpl = '';

    /**
     * Get list_id
     *
     * @return integer 
     */
    public function getListId()
    {
        return $this->list_id;
    }

    /**
     * Set class
     *
     * @param string $class
     * @return ViewList
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * Get class
     *
     * @return string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set list
     *
     * @param string $list
     * @return ViewList
     */
    public function setList($list)
    {
        $this->list = $list;
        return $this;
    }

    /**
     * Get list
     *
     * @return string 
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Set zone
     *
     * @param string $zone
     * @return ViewList
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
     * Set child
     *
     * @param string $child
     * @return ViewList
     */
    public function setChild($child)
    {
        $this->child = $child;
        return $this;
    }

    /**
     * Get child
     *
     * @return string 
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return ViewList
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * Get weight
     *
     * @return integer 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set tpl
     *
     * @param string $tpl
     * @return ViewList
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
}