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

namespace XLite\Module\CDev\VAT\Model;

/**
 * Tax
 *
 * @Entity
 * @Table  (name="vat_taxes")
 */
class Tax extends \XLite\Model\Base\I18n
{
    /**
     * Tax unique ID
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="uinteger")
     */
    protected $id;

    /**
     * Eenabled
     *
     * @var boolean
     *
     * @Column (type="boolean")
     */
    protected $enabled = false;

    /**
     * Tax rates (relation)
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @OneToMany (targetEntity="XLite\Module\CDev\VAT\Model\Tax\Rate", mappedBy="tax", cascade={"all"})
     * @OrderBy ({"position" = "ASC"})
     */
    protected $rates;

    /**
     * VAT base membership
     *
     * @var \XLite\Model\Membership
     *
     * @ManyToOne  (targetEntity="XLite\Model\Membership", cascade={"detach", "merge", "persist"})
     * @JoinColumn (name="vat_membership_id", referencedColumnName="membership_id")
     */
    protected $vatMembership;

    /**
     * VAT base Zone
     *
     * @var \XLite\Model\Zone
     *
     * @ManyToOne  (targetEntity="XLite\Model\Zone", cascade={"detach", "merge", "persist"})
     * @JoinColumn (name="vat_zone_id", referencedColumnName="zone_id")
     */
    protected $vatZone;

    /**
     * Constructor
     *
     * @param array $data Entity properties OPTIONAL
     *
     * @return void
     */
    public function __construct(array $data = array())
    {
        $this->rates = new \Doctrine\Common\Collections\ArrayCollection();

        parent::__construct($data);
    }

    /**
     * Get applicable rates by zones and membership
     *
     * @param array                   $zones      Zone id list
     * @param \XLite\Model\Membership $membership Membership OPTIONAL
     *
     * @return array
     */
    public function getApplicableRates(array $zones, \XLite\Model\Membership $membership = null) {
        $rates = array();

        foreach ($this->getRates() as $rate) {
            $id = $rate->getTaxClass()
                ? ($rate->getNoTaxClass() ? -1 : $rate->getTaxClass()->getId())
                : 0;
            if ($rate->isApplied($zones, $membership, null, true) && !isset($rates[$id])) {
                $rates[$id] = $rate;
                if (!$id) {
                    break;
                }
            }
        }

        return $rates;
    }

    /**
     * Get filtered rates by zones, membership and tax class
     *
     * @param array                   $zones      Zone id list
     * @param \XLite\Model\Membership $membership Membership OPTIONAL
     * @param \XLite\Model\TaxClass   $taxClass   Tax class OPTIONAL
     *
     * @return array
     */
    public function getFilteredRates(
        array $zones,
        \XLite\Model\Membership $membership = null,
        \XLite\Model\TaxClass $taxClass = null
    ) {
        $rates = array();

        foreach ($this->getRates() as $rate) {
            if ($rate->isApplied($zones, $membership, $taxClass) && !isset($rates[$rate->getPosition()])) {
                $rates[$rate->getPosition()] = $rate;
            }
        }
        ksort($rates);

        return $rates;
    }

    /**
     * Get filtered rate by zones, membership and tax class
     *
     * @param array                   $zones      Zone id list
     * @param \XLite\Model\Membership $membership Membership OPTIONAL
     * @param \XLite\Model\TaxClass   $taxClass   Tax class OPTIONAL
     *
     * @return \XLite\Module\CDev\VAT\Model\Tax\Rate
     */
    public function getFilteredRate(
        array $zones,
        \XLite\Model\Membership $membership = null,
        \XLite\Model\TaxClass $taxClass = null
    ) {
        $rates = $this->getFilteredRates($zones, $membership, $taxClass);

        return array_shift($rates);
    }

    /**
     * Set VAT base membership 
     * 
     * @param \XLite\Model\Membership $membership Membership OPTIONAL
     *  
     * @return void
     */
    public function setVATMembership(\XLite\Model\Membership $membership = null)
    {
        $this->vatMembership = $membership;
    }

    /**
     * Set VAT base zone 
     * 
     * @param \XLite\Model\Zone $zone Zone OPTIONAL
     *  
     * @return void
     */
    public function setVATZone(\XLite\Model\Zone $zone = null)
    {
        $this->vatZone = $zone;
    }
}
