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
 
namespace XLite\Module\CDev\XPaymentsConnector\Controller\Customer;

/**
 * Redirect inside iframe 
 * it should redirect the parent window
 */
abstract class ACustomer extends \XLite\Module\CDev\Coupons\Controller\Customer\ACustomer implements \XLite\Base\IDecorator
{
    /**
     * Get iframe singleton
     *
     * @return boolean
     */
    public function getIframe()
    {
        return \XLite\Module\CDev\XPaymentsConnector\Core\Iframe::getInstance();
    }

    /**
     * Redirect
     *
     * @return boolean
     */
    public function doRedirect() 
    {
        if ($this->getIframe()->getEnabled()) {
            $this->getIframe()->finalize();

        } else {

            return parent::doRedirect();

        }
    }

    /**
     * Check if transaction is X-Payments's one and is initialized/in progress 
     *
     * @param \XLite\Model\Payment\Transaction $transaction Transaction
     *
     * @return void
     */
    protected function isTransactionOpenXpayments(\XLite\Model\Payment\Transaction $transaction)
    {
        return $transaction
            && $transaction->isXPC()
            && $transaction->isOpen();
    }

}
