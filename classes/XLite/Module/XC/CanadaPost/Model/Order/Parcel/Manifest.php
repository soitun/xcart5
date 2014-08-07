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

namespace XLite\Module\XC\CanadaPost\Model\Order\Parcel;

/**
 * Class represents a Canada Post Shipment Manifests links (returned by the "Transmit Shipments" request)
 *
 * @Entity
 * @Table  (name="order_capost_parcel_manifests")
 */
class Manifest extends \XLite\Module\XC\CanadaPost\Model\Base\Link
{
    /**
     * PO number for the manifest
     *
     * @var string
     *
     * @Column (type="string", length=255, nullable=true)
     */
    protected $poNumber;

    /**
     * Shipments
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ManyToMany (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment", inversedBy="manifests")
     * @JoinTable (
     *      name="order_capost_parcel_shipments_manifests",
     *      joinColumns={@JoinColumn(name="manifest_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="shipment_id", referencedColumnName="id")}
     * )
     */
    protected $shipments;

    /**
     * This structure represents a list of links to information relating to the manifest (referece to the manifest's links model)
     *
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany (targetEntity="XLite\Module\XC\CanadaPost\Model\Order\Parcel\Manifest\Link", mappedBy="manifest", cascade={"all"})
     */
    protected $links;

    /**
     * Constructor
     *
     * @param array $data Entity properties (OPTIONAL)
     *
     * @return void
     */
    public function __construct(array $data = array())
    {
        $this->shipments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->links = new \Doctrine\Common\Collections\ArrayCollection();
        
        parent::__construct($data);
    }

    /**
     * Associate a shipment
     *
     * @param \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment $shipment Shipment object
     *
     * @return void
     */
    public function addShipment(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Shipment $shipment)
    {
        $this->shipments[] = $shipment;
    }

    /**
     * Add a link to manifest
     *
     * @param \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Manifest\Link $newLink Link object
     *
     * @return void
     */
    public function addLink(\XLite\Module\XC\CanadaPost\Model\Order\Parcel\Manifest\Link $newLink)
    {
        $newLink->setManifest($this);

        $this->addLinks($newLink);
    }
    
    /**
     * Get Canada Post manifest ID
     *
     * @return string|null
     */
    public function getManifestId()
    {
        $manifestId = null;
        
        if ($this->getHref()) {

            preg_match('/manifest\/(\d+)$/', $this->getHref(), $matches);
            
            $manifestId = $matches[1];
        }
        
        return $manifestId;
    }

    // {{{ Canda Post API calls
    
    /**
     * Call "Get Maifest" request
     *
     * @return boolean
     */
    public function callApiGetManifest()
    {
        $result = false;
        
        $data = \XLite\Module\XC\CanadaPost\Core\API::getInstance()->callGetManifestRequest($this);

        if (isset($data->errors)) {
            
            // Save errors
            $this->apiCallErrors = $data->errors;

        } else {

            sleep(2); // to get Canada Post server time to generate PDF documents

            $this->setPoNumber($data->poNumber);

            foreach ($data->links as $link) {

                $manifestLink = new \XLite\Module\XC\CanadaPost\Model\Order\Parcel\Manifest\Link();
                $manifestLink->setManifest($this);

                $this->addLink($manifestLink);

                foreach (array('rel', 'href', 'mediaType', 'idx') as $linkField) {

                    if (isset($link->{$linkField})) {
                        $manifestLink->{'set' . \XLite\Core\Converter::convertToCamelCase($linkField)}($link->{$linkField});
                    }
                }

                if (
                    !$manifestLink->callApiGetArtifact()
                    && $manifestLink->getApiCallErrors()
                ) {
                    // Error is occurred while downloading PDF documents
                    if (!isset($this->apiCallErrors)) {
                        $this->apiCallErrors = array();
                    }

                    $this->apiCallErrors += $manifestLink->getApiCallErrors();
                }
            }

            \XLite\Core\Database::getEM()->flush();
 
            $result = true;
        }

        return $result;
    }

    // }}}
}
