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
 * Measure
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Measure")
 * @Table  (name="measures")
 */
class Measure extends \XLite\Model\AEntity
{
    /**
     * Unique id
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="uinteger")
     */
    protected $id;

    /**
     * Date (UNIX timestamp)
     *
     * @var integer
     *
     * @Column (type="uinteger")
     */
    protected $date;

    /**
     * File system test : time (msec.)
     *
     * @var integer
     *
     * @Column (type="uinteger")
     */
    protected $fsTime;

    /**
     * Database test : time (msec.)
     *
     * @var integer
     *
     * @Column (type="uinteger")
     */
    protected $dbTime;

    /**
     * Camputation test : time (msec.)
     *
     * @var integer
     *
     * @Column (type="uinteger")
     */
    protected $cpuTime;

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
     * Set date
     *
     * @param uinteger $date
     * @return Measure
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * Get date
     *
     * @return uinteger 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set fsTime
     *
     * @param uinteger $fsTime
     * @return Measure
     */
    public function setFsTime($fsTime)
    {
        $this->fsTime = $fsTime;
        return $this;
    }

    /**
     * Get fsTime
     *
     * @return uinteger 
     */
    public function getFsTime()
    {
        return $this->fsTime;
    }

    /**
     * Set dbTime
     *
     * @param uinteger $dbTime
     * @return Measure
     */
    public function setDbTime($dbTime)
    {
        $this->dbTime = $dbTime;
        return $this;
    }

    /**
     * Get dbTime
     *
     * @return uinteger 
     */
    public function getDbTime()
    {
        return $this->dbTime;
    }

    /**
     * Set cpuTime
     *
     * @param uinteger $cpuTime
     * @return Measure
     */
    public function setCpuTime($cpuTime)
    {
        $this->cpuTime = $cpuTime;
        return $this;
    }

    /**
     * Get cpuTime
     *
     * @return uinteger 
     */
    public function getCpuTime()
    {
        return $this->cpuTime;
    }
}