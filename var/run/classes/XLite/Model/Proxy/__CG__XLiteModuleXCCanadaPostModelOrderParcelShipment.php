<?php

namespace XLite\Model\Proxy\__CG__\XLite\Module\XC\CanadaPost\Model\Order\Parcel;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Shipment extends \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment implements \Doctrine\ORM\Proxy\Proxy
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

    
    public function setParcel(\XLite\Module\XC\CanadaPost\Model\Order\Parcel $parcel = NULL)
    {
        $this->__load();
        return parent::setParcel($parcel);
    }

    public function addLink(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link $newLink)
    {
        $this->__load();
        return parent::addLink($newLink);
    }

    public function addManifest(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Manifest $manifest)
    {
        $this->__load();
        return parent::addManifest($manifest);
    }

    public function setTrackingDetails(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Tracking $tracking = NULL)
    {
        $this->__load();
        return parent::setTrackingDetails($tracking);
    }

    public function getTrackingDetails()
    {
        $this->__load();
        return parent::getTrackingDetails();
    }

    public function hasManifests()
    {
        $this->__load();
        return parent::hasManifests();
    }

    public function getLinkByRel($rel)
    {
        $this->__load();
        return parent::getLinkByRel($rel);
    }

    public function getPDFLinks()
    {
        $this->__load();
        return parent::getPDFLinks();
    }

    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function setShipmentId($shipmentId)
    {
        $this->__load();
        return parent::setShipmentId($shipmentId);
    }

    public function getShipmentId()
    {
        $this->__load();
        return parent::getShipmentId();
    }

    public function setShipmentStatus($shipmentStatus)
    {
        $this->__load();
        return parent::setShipmentStatus($shipmentStatus);
    }

    public function getShipmentStatus()
    {
        $this->__load();
        return parent::getShipmentStatus();
    }

    public function setTrackingPin($trackingPin)
    {
        $this->__load();
        return parent::setTrackingPin($trackingPin);
    }

    public function getTrackingPin()
    {
        $this->__load();
        return parent::getTrackingPin();
    }

    public function setReturnTrackingPin($returnTrackingPin)
    {
        $this->__load();
        return parent::setReturnTrackingPin($returnTrackingPin);
    }

    public function getReturnTrackingPin()
    {
        $this->__load();
        return parent::getReturnTrackingPin();
    }

    public function setPoNumber($poNumber)
    {
        $this->__load();
        return parent::setPoNumber($poNumber);
    }

    public function getPoNumber()
    {
        $this->__load();
        return parent::getPoNumber();
    }

    public function getParcel()
    {
        $this->__load();
        return parent::getParcel();
    }

    public function addLinks(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment\Link $links)
    {
        $this->__load();
        return parent::addLinks($links);
    }

    public function getLinks()
    {
        $this->__load();
        return parent::getLinks();
    }

    public function addManifests(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Manifest $manifests)
    {
        $this->__load();
        return parent::addManifests($manifests);
    }

    public function getManifests()
    {
        $this->__load();
        return parent::getManifests();
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
        return array('__isInitialized__', 'id', 'shipmentId', 'shipmentStatus', 'trackingPin', 'returnTrackingPin', 'poNumber', 'parcel', 'links', 'manifests', 'trackingDetails');
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