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

namespace XLite\Module\CDev\Paypal\Controller\Admin;

/**
 * Payment method page controller
 */
class PaymentMethod extends \XLite\Controller\Admin\PaymentMethod implements \XLite\Base\IDecorator
{
    /**
     * Modify request to allow process specific GET-actions
     *
     * @return string
     */
    public function handleRequest()
    {
        if (
            isset(\XLite\Core\Request::getInstance()->action)
            && $this->isPaypalInstructionAction()
        ) {
            \XLite\Core\Request::getInstance()->setRequestMethod('POST');
        }

        parent::handleRequest();
    }


    /**
     * Return true if action is hide/show instruction
     * 
     * @return boolean
     */
    protected function isPaypalInstructionAction()
    {
        return in_array(
            \XLite\Core\Request::getInstance()->action,
            array(
                'hide_instruction',
                'show_instruction',
            )
        );
    }

    /**
     * Hide payment settings instruction block
     *
     * @return void
     */
    protected function doActionHideInstruction()
    {
        $this->switchDisplayInstructionFlag(true);
    }

    /**
     * Hide payment settings instruction block
     *
     * @return void
     */
    protected function doActionShowInstruction()
    {
        $this->switchDisplayInstructionFlag(false);
    }

    /**
     * Switch hide_instruction parameter 
     * 
     * @param boolean $value Value of parameter
     *  
     * @return void
     */
    protected function switchDisplayInstructionFlag($value)
    {
        $paymentMethod = $this->getPaymentMethod();

        if ($paymentMethod) {
            $paymentMethod->setSetting('hide_instruction', $value);
            \XLite\Core\Database::getRepo('\XLite\Model\Payment\Method')->update($paymentMethod);
        }

        $this->setReturnURL(
            $this->buildURL(
                'payment_method',
                null,
                array('method_id' => \XLite\Core\Request::getInstance()->method_id)
            )
        );
    }
}
