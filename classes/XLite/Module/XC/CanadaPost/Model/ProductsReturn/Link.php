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

namespace XLite\Module\XC\CanadaPost\Model\ProductsReturn;

/**
 * Class represents a Canada Post return links
 *
 * @Entity
 * @Table  (name="capost_return_links")
 */
class Link extends \XLite\Module\XC\CanadaPost\Model\Base\Link
{
    /**
     * Reference to the Canada Post return model
     *
     * @var \XLite\Module\XC\CanadaPost\Model\ProductsReturn
     *
     * @ManyToOne  (targetEntity="XLite\Module\XC\CanadaPost\Model\ProductsReturn", inversedBy="links")
     * @JoinColumn (name="returnId", referencedColumnName="id")
     */
    protected $return;

    /**
     * Relation to a storage entity
     *
     * @var \XLite\Module\XC\CanadaPost\Model\ProductsReturn\Link\Storage
     *
     * @OneToOne (targetEntity="XLite\Module\XC\CanadaPost\Model\ProductsReturn\Link\Storage", mappedBy="link", cascade={"all"}, fetch="EAGER")
     */
    protected $storage;

	// {{{ Service methods

    /**
     * Set return
     *
     * @param \XLite\Module\XC\CanadaPost\Model\ProductsReturn $return Return model (OPTIONAL)
     *
     * @return void
     */
    public function setReturn(\XLite\Module\XC\CanadaPost\Model\ProductsReturn $return = null)
    {
        $this->return = $return;
    }

    /**
     * Set storage
     *
     * @param \XLite\Module\XC\CanadaPost\Model\ProductsReturn\Link\Storage $storage Storage object
     *
     * @return void
     */
    public function setStorage(\XLite\Module\XC\CanadaPost\Model\ProductsReturn\Link\Storage $storage)
    {
        $storage->setLink($this);
        
        $this->storage = $storage;
    }

	// }}}
    
    /**
     * Get store class
     *
     * @return string
     */
    protected function getStorageClass()
    {
        return '\XLite\Module\XC\CanadaPost\Model\ProductsReturn\Link\Storage';
    }

    /**
     * Get filename for PDF documents
     *
     * @return string
     */
    public function getFileName()
    {
        $prefix = static::getAllowedRelsPrefixes($this->getRel());

        return $prefix . $this->getReturn()->getId() . $this->getReturn()->getOrder()->getOrderId() . '.pdf';
    }   
}
