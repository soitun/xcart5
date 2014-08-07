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

namespace XLite\Module\XC\CanadaPost\Controller\Admin;

/**
 * Products return controller
 */
class CapostReturn extends \XLite\Controller\Admin\AAdmin
{
    /**
     * Controller parameters
     *
     * @var array
     */
    protected $params = array('target', 'id');

    /**
     * Check ACL permissions
     *
     * @return boolean
     */
    public function checkACL()
    {
        return parent::checkACL()
            || \XLite\Core\Auth::getInstance()->isPermissionAllowed('manage returns');
    }

    /**
     * Return the current products_return title (for the content area)
     *
     * @return string
     */
    public function getTitle()
    {
        return static::t('Return') . ' ' . $this->getProductsReturn()->getNumber();
    }

    /**
     * Check if current page is accessible
     *
     * @return boolean
     */
    public function checkAccess()
    {
        return parent::checkAccess()
            && $this->getProductsReturn();
    }

    /**
     * Get products return ID
     *
     * @return integer
     */
    protected function getProductsReturnId()
    {
        return intval(\XLite\Core\Request::getInstance()->id);
    }

    // {{{ Actions

    /**
     * Update model
     *
     * @return void
     */
    protected function doActionUpdate()
    {
        \XLite\Core\Database::getRepo('XLite\Module\XC\CanadaPost\Model\ProductsReturn')
            ->updateById($this->getProductsReturnId(), $this->getPostedData());
    }

    /**
     * Return requested changes for the order
     *
     * @param \XLite\Module\XC\CanadaPost\Model\ProductsReturn $return Canada Post products return model
     * @param array                                            $data  Data to change
     *
     * @return array
     */
    protected function getProductsReturnChanges(\XLite\Module\XC\CanadaPost\Model\ProductsReturn $return, array $data)
    {
        $changes = array();

        foreach ($data as $name => $value) {

            if ('status' === $name) {
                continue;
            }

            $returnValue = $return->{'get' . ucfirst($name)}();

            if ($returnrValue !== $value) {

                $changes[$name] = array(
                    'old' => $returnValue,
                    'new' => $value,
                );
            }
        }

        return $changes;
    }

    // }}}

    // {{{ Common methods
    
    /**
     * Get products return model
     *
     * @return \XLite\Module\XC\CanadaPost\Model\ProductsReturn|null
     */
    public function getProductsReturn()
    {
        return \XLite\Core\Database::getRepo('\XLite\Module\XC\CanadaPost\Model\ProductsReturn')
            ->find($this->getProductsReturnId());
    }
    
    /**
     * Get related order model
     *
     * @return \XLite\Model\Order
     */
    public function getOrder()
    {
        return $this->getProductsReturn()->getOrder();
    }

    // }}}
}
