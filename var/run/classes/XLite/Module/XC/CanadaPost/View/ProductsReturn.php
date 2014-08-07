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

namespace XLite\Module\XC\CanadaPost\View;

/**
 * Products return page view
 *
 * @ListChild (list="admin.center", zone="admin")
 */
class ProductsReturn extends \XLite\View\AView
{
    /**
     * Return list of allowed targets
     *
     * @return array
     */
    public static function getAllowedTargets()
    {
        return array_merge(parent::getAllowedTargets(), array('capost_return'));
    }

    /**
     * Register CSS files
     *
     * @return array
     */
    public function getCSSFiles()
    {
        $list = parent::getCSSFiles();
        $list[] = 'modules/XC/CanadaPost/products_return/style.css';

        return $list;
    }

    /**
     * Return widget default template
     *
     * @return string
     */
    protected function getDefaultTemplate()
    {
        return 'modules/XC/CanadaPost/products_return/body.tpl';
    }

    // {{{ Helper methods

    /**
     * Check - has profile separate modification page or not
     *
     * @return boolean
     */
    protected function hasProfilePage()
    {
        return $this->getOrder()->getOrigProfile()
            && $this->getOrder()->getOrigProfile()->getProfileId() != $this->getOrder()->getProfile()->getProfileId();
    }

    /**
     * Get profile name
     *
     * @return string
     */
    protected function getProfileName()
    {
        $profile = $this->getOrder()->getProfile();

        $address = $profile->getBillingAddress() ?: $profile->getShippingAddress();

        if (!$address) {
            $profile->getAddresses()->first();
        }

        return $address ? $address->getName() : $profile->getLogin();
    }

    /**
     * Get profile URL
     *
     * @return string
     */
    protected function getProfileURL()
    {
        return \XLite\Core\Converter::buildURL(
            'profile',
            '',
            array('profile_id' => $this->getOrder()->getOrigProfile()->getProfileId())
        );
    }

    /**
     * Get products return formatted creation date
     *
     * @return string
     */
    protected function getCreateDate()
    {
        return $this->formatTime($this->getProductsReturn()->getDate());
    }

    /**
     * Get membership
     *
     * @return \XLite\Model\Membership
     */
    protected function getMembership()
    {
        return $this->getOrder()->getOrigProfile()
            ? $this->getOrder()->getOrigProfile()->getMembership()
            : null;
    }

    /**
     * Check - customer notes block is visible or not
     *
     * @return boolean
     */
    protected function isCustomerNotesVisible()
    {
        return (bool) $this->getProductsReturn()->getNotes();
    }

    // }}}
}
