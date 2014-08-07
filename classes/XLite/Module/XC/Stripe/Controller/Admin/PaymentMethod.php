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
 * Payment method
 */
abstract class PaymentMethod extends \XLite\Controller\Admin\PaymentMethod implements \XLite\Base\IDecorator
{

    /**
     * Run controller
     *
     * @return void
     */
    protected function run()
    {
        if (!$this->getAction()) {
            $method = $this->getPaymentMethod();
            if (
                $method->getProcessor() instanceOf \XLite\Module\XC\Stripe\Model\Payment\Stripe
                && $method->getSetting('accessToken')
                && !$method->getProcessor()->retrieveAcount()
            ) {
                
                $prefix = $method->getProcessor()->isTestMode($method) ? 'Test' : 'Live';
                $method->setSetting('accessToken' . $prefix, null);
                $method->setSetting('publishKey' . $prefix, null);
                \XLite\Core\Database::getEM()->flush();

                \XLite\Core\TopMessage::addWarning(
                    'Your Stripe account is no longer accessible. Please connect with Stripe once again.'
                );
            }
        }

        parent::run();
    }

    /**
     * Update payment method
     *
     * @return void
     */
    protected function doActionUpdate()
    {
        $method = $this->getPaymentMethod();
        if ($method->getProcessor() instanceOf \XLite\Module\XC\Stripe\Model\Payment\Stripe) {
            $oldTestValue = $method->getSetting('mode');
        }

        parent::doActionUpdate();

        if ($method->getProcessor() instanceOf \XLite\Module\XC\Stripe\Model\Payment\Stripe) {
            $newTestValue = $method->getSetting('mode');
            $prefix = $method->getProcessor()->isTestMode($method) ? 'Test' : 'Live';
            if ($newTestValue != $oldTestValue && !$method->getSetting('accessToken' . $prefix)) {
                list($result, $error) = \XLite\Module\XC\Stripe\Core\OAuth::getInstance()->refreshToken($method);

                if (!empty($error)) {
                    \XLite\Core\TopMessage::addError($error);
                    $method->setSetting('mode', $oldTestValue);
                    $this->setReturnURL(
                        \XLite\Core\Converter::buildURL(
                            'payment_method',
                            null,
                            array('method_id' => $method->getMethodId())
                        )
                    );
                }

                \Xlite\Core\Database::getEM()->flush();
            }
        }
    }
}
