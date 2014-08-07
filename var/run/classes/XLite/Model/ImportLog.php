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
 * Import log
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\ImportLog")
 * @Table  (name="import_logs")
 *
 * @HasLifecycleCallbacks
 */
class ImportLog extends \XLite\Model\AEntity
{

    /**
     * Type codes 
     */
    const TYPE_WARNING = 'W';
    const TYPE_ERROR   = 'E';

    /**
     * ID
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="uinteger")
     */
    protected $id;

    /**
     * Date
     *
     * @var   integer
     *
     * @Column (type="integer")
     */
    protected $date;

    /**
     * Type
     *
     * @var   string
     *
     * @Column (type="fixedstring", length=1)
     */
    protected $type = self::TYPE_WARNING;

    /**
     * Code
     *
     * @var   string
     *
     * @Column (type="fixedstring", length=32)
     */
    protected $code;

    /**
     * Arguments
     *
     * @var   array
     *
     * @Column (type="array")
     */
    protected $arguments;

    /**
     * File
     *
     * @var   string
     *
     * @Column (type="string")
     */
    protected $file;

    /**
     * Row
     *
     * @var   integer
     *
     * @Column (type="uinteger")
     */
    protected $row;

    /**
     * Processor
     *
     * @var   string
     *
     * @Column (type="string")
     */
    protected $processor;

    /**
     * Update date 
     * 
     * @return void
     * @PrePersist
     */
    public function updateDate()
    {
        $this->setDate(\XLite\Core\Converter::time());
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
     * Set date
     *
     * @param integer $date
     * @return ImportLog
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
     * Set type
     *
     * @param fixedstring $type
     * @return ImportLog
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return fixedstring 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set code
     *
     * @param fixedstring $code
     * @return ImportLog
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
     * Set arguments
     *
     * @param array $arguments
     * @return ImportLog
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
        return $this;
    }

    /**
     * Get arguments
     *
     * @return array 
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Set file
     *
     * @param string $file
     * @return ImportLog
     */
    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set row
     *
     * @param uinteger $row
     * @return ImportLog
     */
    public function setRow($row)
    {
        $this->row = $row;
        return $this;
    }

    /**
     * Get row
     *
     * @return uinteger 
     */
    public function getRow()
    {
        return $this->row;
    }

    /**
     * Set processor
     *
     * @param string $processor
     * @return ImportLog
     */
    public function setProcessor($processor)
    {
        $this->processor = $processor;
        return $this;
    }

    /**
     * Get processor
     *
     * @return string 
     */
    public function getProcessor()
    {
        return $this->processor;
    }
}