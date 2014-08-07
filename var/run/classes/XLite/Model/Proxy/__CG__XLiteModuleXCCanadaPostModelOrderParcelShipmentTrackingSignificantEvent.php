<?php

namespace XLite\Model\Proxy\__CG__\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class SignificantEvent extends \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking\SignificantEvent implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function setTrackingDetails(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking $tracking = NULL)
    {
        $this->__load();
        return parent::setTrackingDetails($tracking);
    }

    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function setIdentifier($identifier)
    {
        $this->__load();
        return parent::setIdentifier($identifier);
    }

    public function getIdentifier()
    {
        $this->__load();
        return parent::getIdentifier();
    }

    public function setDate($date)
    {
        $this->__load();
        return parent::setDate($date);
    }

    public function getDate()
    {
        $this->__load();
        return parent::getDate();
    }

    public function setTime($time)
    {
        $this->__load();
        return parent::setTime($time);
    }

    public function getTime()
    {
        $this->__load();
        return parent::getTime();
    }

    public function setTimeZone($timeZone)
    {
        $this->__load();
        return parent::setTimeZone($timeZone);
    }

    public function getTimeZone()
    {
        $this->__load();
        return parent::getTimeZone();
    }

    public function setDescription($description)
    {
        $this->__load();
        return parent::setDescription($description);
    }

    public function getDescription()
    {
        $this->__load();
        return parent::getDescription();
    }

    public function setSignatoryName($signatoryName)
    {
        $this->__load();
        return parent::setSignatoryName($signatoryName);
    }

    public function getSignatoryName()
    {
        $this->__load();
        return parent::getSignatoryName();
    }

    public function setSite($site)
    {
        $this->__load();
        return parent::setSite($site);
    }

    public function getSite()
    {
        $this->__load();
        return parent::getSite();
    }

    public function setProvince($province)
    {
        $this->__load();
        return parent::setProvince($province);
    }

    public function getProvince()
    {
        $this->__load();
        return parent::getProvince();
    }

    public function setRetailLocationId($retailLocationId)
    {
        $this->__load();
        return parent::setRetailLocationId($retailLocationId);
    }

    public function getRetailLocationId()
    {
        $this->__load();
        return parent::getRetailLocationId();
    }

    public function setRetailName($retailName)
    {
        $this->__load();
        return parent::setRetailName($retailName);
    }

    public function getRetailName()
    {
        $this->__load();
        return parent::getRetailName();
    }

    public function getTrackingDetails()
    {
        $this->__load();
        return parent::getTrackingDetails();
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
        return array('__isInitialized__', 'id', 'identifier', 'date', 'time', 'timeZone', 'description', 'signatoryName', 'site', 'province', 'retailLocationId', 'retailName', 'trackingDetails');
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