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

namespace XLite\Module\CDev\PINCodes\Controller\Admin;

/**
 * Product modify
 *
 */
class Product extends \XLite\Controller\Admin\Product implements \XLite\Base\IDecorator
{
    /**
     * Update pin codes action handler
     *
     * @return void
     */
    public function doActionUpdatePinCodes()
    {
        $product = $this->getProduct();

        $product->setPinCodesEnabled((bool)\XLite\Core\Request::getInstance()->pins_enabled);
        $product->setAutoPinCodes(\XLite\Core\Request::getInstance()->autoPinCodes);

        if (\XLite\Core\Request::getInstance()->delete) {
            foreach (\XLite\Core\Request::getInstance()->delete as $id => $checked) {
                $obj = \XLite\Core\Database::getRepo('XLite\Module\CDev\PINCodes\Model\PinCode')->findOneBy(
                    array(
                        'id' => $id,
                        'product' => $product->getId(),
                        'isSold' => 0
                    )
                );
                if ($obj) {
                    \XLite\Core\Database::getEM()->remove($obj);
                }
            }
        }

        \XLite\Core\Database::getEM()->flush();

        \XLite\Core\TopMessage::addInfo('PIN codes data have been successfully updated');
    }

    /**
     * Get pages sections
     *
     * @return array
     */
    public function getPages()
    {
        $pages = parent::getPages();

        if (!$this->isNew()) {
            $pages += array(
                'pin_codes' => 'PIN codes',
            );
        }

        return $pages;
    }

    /**
     * Get pages templates
     *
     * @return array
     */
    protected function getPageTemplates()
    {
        $tpls = parent::getPageTemplates();

        if (!$this->isNew()) {
            $tpls += array(
                'pin_codes' => 'modules/CDev/PINCodes/product/pin_codes.tpl',
            );
        }

        return $tpls;
    }
}
