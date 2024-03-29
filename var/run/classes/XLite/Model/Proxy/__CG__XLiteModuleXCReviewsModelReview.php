<?php

namespace XLite\Model\Proxy\__CG__\XLite\Module\XC\Reviews\Model;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Review extends \XLite\Module\XC\Reviews\Model\Review implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function isNew()
    {
        $this->__load();
        return parent::isNew();
    }

    public function isApproved()
    {
        $this->__load();
        return parent::isApproved();
    }

    public function isNotApproved()
    {
        $this->__load();
        return parent::isNotApproved();
    }

    public function prepareBeforeCreate()
    {
        $this->__load();
        return parent::prepareBeforeCreate();
    }

    public function getId()
    {
        $this->__load();
        return parent::getId();
    }

    public function setReview($review)
    {
        $this->__load();
        return parent::setReview($review);
    }

    public function getReview()
    {
        $this->__load();
        return parent::getReview();
    }

    public function setRating($rating)
    {
        $this->__load();
        return parent::setRating($rating);
    }

    public function getRating()
    {
        $this->__load();
        return parent::getRating();
    }

    public function setAdditionDate($additionDate)
    {
        $this->__load();
        return parent::setAdditionDate($additionDate);
    }

    public function getAdditionDate()
    {
        $this->__load();
        return parent::getAdditionDate();
    }

    public function setReviewerName($reviewerName)
    {
        $this->__load();
        return parent::setReviewerName($reviewerName);
    }

    public function getReviewerName()
    {
        $this->__load();
        return parent::getReviewerName();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function setStatus($status)
    {
        $this->__load();
        return parent::setStatus($status);
    }

    public function getStatus()
    {
        $this->__load();
        return parent::getStatus();
    }

    public function setIp($ip)
    {
        $this->__load();
        return parent::setIp($ip);
    }

    public function getIp()
    {
        $this->__load();
        return parent::getIp();
    }

    public function setProfile(\XLite\Model\Profile $profile = NULL)
    {
        $this->__load();
        return parent::setProfile($profile);
    }

    public function getProfile()
    {
        $this->__load();
        return parent::getProfile();
    }

    public function setProduct(\XLite\Model\Product $product = NULL)
    {
        $this->__load();
        return parent::setProduct($product);
    }

    public function getProduct()
    {
        $this->__load();
        return parent::getProduct();
    }

    public function map(array $data)
    {
        $this->__load();
        return parent::map($data);
    }

    public function __get($name)
    {
        $this->__load();
        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        $this->__load();
        return parent::__set($name, $value);
    }

    public function __isset($name)
    {
        $this->__load();
        return parent::__isset($name);
    }

    public function __unset($name)
    {
        $this->__load();
        return parent::__unset($name);
    }

    public function getRepository()
    {
        $this->__load();
        return parent::getRepository();
    }

    public function checkCache()
    {
        $this->__load();
        return parent::checkCache();
    }

    public function detach()
    {
        $this->__load();
        return parent::detach();
    }

    public function __call($method, array $args = array (
))
    {
        $this->__load();
        return parent::__call($method, $args);
    }

    public function setterProperty($property, $value)
    {
        $this->__load();
        return parent::setterProperty($property, $value);
    }

    public function getterProperty($property)
    {
        $this->__load();
        return parent::getterProperty($property);
    }

    public function isPersistent()
    {
        $this->__load();
        return parent::isPersistent();
    }

    public function isDetached()
    {
        $this->__load();
        return parent::isDetached();
    }

    public function getUniqueIdentifierName()
    {
        $this->__load();
        return parent::getUniqueIdentifierName();
    }

    public function getUniqueIdentifier()
    {
        $this->__load();
        return parent::getUniqueIdentifier();
    }

    public function update()
    {
        $this->__load();
        return parent::update();
    }

    public function create()
    {
        $this->__load();
        return parent::create();
    }

    public function delete()
    {
        $this->__load();
        return parent::delete();
    }

    public function processFiles($field, array $data)
    {
        $this->__load();
        return parent::processFiles($field, $data);
    }

    public function cloneEntity()
    {
        $this->__load();
        return parent::cloneEntity();
    }

    public function prepareEntityBeforeCommit($type)
    {
        $this->__load();
        return parent::prepareEntityBeforeCommit($type);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'review', 'rating', 'additionDate', 'reviewerName', 'email', 'status', 'ip', 'profile', 'product');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}