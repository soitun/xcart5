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

namespace XLite\Model\Payment;

/**
 * Something customer can put into his cart
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Payment\MethodSetting")
 * @Table (name="payment_method_settings",
 *      indexes={
 *          @Index (name="mn", columns={"method_id","name"})
 *      }
 * )
 */
class MethodSetting extends \XLite\Model\AEntity
{
    /**
     * Primary key
     *
     * @var integer
     *
     * @Id
     * @GeneratedValue (strategy="AUTO")
     * @Column         (type="integer")
     */
    protected $setting_id;

    /**
     * Setting name
     *
     * @var string
     *
     * @Column (type="string", length=128)
     */
    protected $name;

    /**
     * Value
     *
     * @var string
     *
     * @Column (type="text")
     */
    protected $value = '';

    /**
     * Payment method
     *
     * @var \XLite\Model\Payment\Method
     *
     * @ManyToOne  (targetEntity="XLite\Model\Payment\Method", inversedBy="settings")
     * @JoinColumn (name="method_id", referencedColumnName="method_id")
     */
    protected $payment_method;

    /**
     * Get setting_id
     *
     * @return integer 
     */
    public function getSettingId()
    {
        return $this->setting_id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return MethodSetting
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param text $value
     * @return MethodSetting
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return text 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set payment_method
     *
     * @param XLite\Model\Payment\Method $paymentMethod
     * @return MethodSetting
     */
    public function setPaymentMethod(\XLite\Model\Payment\Method $paymentMethod = null)
    {
        $this->payment_method = $paymentMethod;
        return $this;
    }

    /**
     * Get payment_method
     *
     * @return XLite\Model\Payment\Method 
     */
    public function getPaymentMethod()
    {
        return $this->payment_method;
    }
}