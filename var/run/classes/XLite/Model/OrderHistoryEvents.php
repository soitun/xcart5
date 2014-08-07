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
 * Order history events
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\OrderHistoryEvents")
 * @Table (name="order_history_events")
 * @HasLifecycleCallbacks
 */
class OrderHistoryEvents extends \XLite\Model\AEntity
{
    /**
     * Order history event unique id
     *
     * @var mixed
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer")
     */
    protected $event_id;

    /**
     * Event creation timestamp
     *
     * @var integer
     *
     * @Column (type="integer")
     */
    protected $date;

    /**
     * Code of event
     *
     * @var string
     *
     * @Column (type="string", length=255)
     */
    protected $code;

    /**
     * Human-readable description of event
     *
     * @var string
     *
     * @Column (type="string", length=1024, nullable=true)
     */
    protected $description;

    /**
     * Data for human-readable description
     *
     * @var string
     *
     * @Column (type="array")
     */
    protected $data;

    /**
     * Event comment
     *
     * @var string
     *
     * @Column (type="text")
     */
    protected $comment = '';

    /**
     * Event details
     *
     * @var \XLite\Model\OrderHistoryEventsData
     *
     * @OneToMany (targetEntity="XLite\Model\OrderHistoryEventsData", mappedBy="event", cascade={"all"})
     */
    protected $details;

    /**
     * Relation to a order entity
     *
     * @var \XLite\Model\Order
     *
     * @ManyToOne  (targetEntity="XLite\Model\Order", inversedBy="events", fetch="LAZY")
     * @JoinColumn (name="order_id", referencedColumnName="order_id")
     */
    protected $order;

    /**
     * Author profile of the event
     *
     * @var \XLite\Model\Profile
     *
     * @ManyToOne   (targetEntity="XLite\Model\Profile", inversedBy="event", cascade={"merge","detach","persist"})
     * @JoinColumn (name="author_id", referencedColumnName="profile_id")
     */
    protected $author;


    /**
     * Prepare order event before save data operation
     *
     * @return void
     *
     * @PrePersist
     * @PreUpdate
     */
    public function prepareBeforeSave()
    {
        if (!is_numeric($this->date)) {
            $this->setDate(\XLite\Core\Converter::time());
        }
    }

    /**
     * Description getter
     *
     * @return string
     */
    public function getDescription()
    {
        return static::t($this->description, (array)$this->getData());
    }

    /**
     * Details setter
     *
     * @param array $details Array of event details array($name => $value)
     *
     * @return void
     */
    public function setDetails(array $details)
    {
        if (!empty($details)) {

            foreach ($details as $detail) {

                $data = new \XLite\Model\OrderHistoryEventsData();
                $data->setName($detail['name']);
                $data->setValue($detail['value']);
                $this->addDetails($data);
                $data->setEvent($this);
            }
        }
    }

    /**
     * Get event_id
     *
     * @return integer 
     */
    public function getEventId()
    {
        return $this->event_id;
    }

    /**
     * Set date
     *
     * @param integer $date
     * @return OrderHistoryEvents
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
     * Set code
     *
     * @param string $code
     * @return OrderHistoryEvents
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return OrderHistoryEvents
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set data
     *
     * @param array $data
     * @return OrderHistoryEvents
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Get data
     *
     * @return array 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set comment
     *
     * @param text $comment
     * @return OrderHistoryEvents
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }

    /**
     * Get comment
     *
     * @return text 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Add details
     *
     * @param XLite\Model\OrderHistoryEventsData $details
     * @return OrderHistoryEvents
     */
    public function addDetails(\XLite\Model\OrderHistoryEventsData $details)
    {
        $this->details[] = $details;
        return $this;
    }

    /**
     * Get details
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set order
     *
     * @param XLite\Model\Order $order
     * @return OrderHistoryEvents
     */
    public function setOrder(\XLite\Model\Order $order = null)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get order
     *
     * @return XLite\Model\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set author
     *
     * @param XLite\Model\Profile $author
     * @return OrderHistoryEvents
     */
    public function setAuthor(\XLite\Model\Profile $author = null)
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Get author
     *
     * @return XLite\Model\Profile 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}