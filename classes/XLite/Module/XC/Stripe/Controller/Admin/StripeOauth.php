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

namespace XLite\Module\XC\Stripe\Controller\Admin;

/**
 * Stripe OAuth endpoint
 */
class StripeOauth extends \XLite\Controller\Admin\AAdmin
{
    /**
     * Check if current page is accessible
     *
     * @return boolean
     */
    public function checkAccess()
    {
        return parent::checkAccess()
            && (!empty(\XLite\Core\Request::getInstance()->code) || $this->getAction())
            && $this->getPaymentMethod()
            && ('refresh' != $this->getAction() || $this->getPaymentMethod()->getSetting('refreshToken'))
            && ($this->getAction() || $this->checkStripeCode());
    }

    /**
     * Check Stripe return code 
     * 
     * @return boolean
     */
    protected function checkStripeCode()
    {
        $oauth = \XLite\Module\XC\Stripe\Core\OAuth::getInstance();

        return \XLite\Core\Request::getInstance()->state == $oauth->defineURLState();
    }

    /**
     * Disconnect 
     * 
     * @return void
     */
    protected function doActionDisconnect()
    {
        $this->getPaymentMethod()->setSetting('accessTokenTest', null);
        $this->getPaymentMethod()->setSetting('publishKeyTest', null);
        $this->getPaymentMethod()->setSetting('accessTokenLive', null);
        $this->getPaymentMethod()->setSetting('publishKeyLive', null);
        $this->getPaymentMethod()->setSetting('refreshToken', null);
        $this->getPaymentMethod()->setSetting('userId', null);
    
        \XLite\Core\Database::getEM()->flush();

        $this->setReturnURL(
            \XLite\Core\Converter::buildURL(
                'payment_method',
                null,
                array('method_id' => $this->getPaymentMethod()->getMethodId())
            )
        );
    }

    /**
     * Preprocessor for no-action run
     *
     * @return void
     */
    protected function doNoAction()
    {
        $method = $this->getPaymentMethod();

        list($result, $error) = \XLite\Module\XC\Stripe\Core\OAuth::getInstance()->authorize(
            $method,
            \XLite\Core\Request::getInstance()->code
        );

        if (!empty($error)) {
            \XLite\Core\TopMessage::addError($error);
        }

        \XLite\Core\Database::getEM()->flush();

        $this->setReturnURL(
            \XLite\Core\Converter::buildURL('payment_method', null, array('method_id' => $method->getMethodId()))
        );
    }

    /**
     * Get payment method 
     * 
     * @return \XLite\Model\Payment\Method
     */
    protected function getPaymentMethod()
    {
        return \XLite\Core\Database::getRepo('XLite\Model\Payment\Method')
            ->findOneBy(array('service_name' => 'Stripe'));
    }
}

