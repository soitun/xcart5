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

namespace XLite\Model;

/**
 * Cart
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Cart")
 * @HasLifecycleCallbacks
 */
class Cart extends \XLite\Model\Order
{
    /**
     * Cart renew period
     */
    const RENEW_PERIOD = 3600;


    /**
     * Array of instances for all derived classes
     *
     * @var array
     */
    protected static $instances = array();

    /**
     * Flag to ignore long calculation for speed up purposes
     *
     * @var boolean
     */
    protected static $ignoreLongCalculations = false;

    /**
     * Method to access a singleton
     *
     * @param $doCalculate Flag for cart recalculation
     *
     * @return \XLite\Model\Cart
     */
    public static function getInstance($doCalculate = true)
    {
        $className = get_called_class();

        // Create new instance of the object (if it is not already created)
        if (!isset(static::$instances[$className])) {
            $auth = \XLite\Core\Auth::getInstance();

            if ($auth->isLogged()) {
                // Try to find cart of logged in user
                $cart = \XLite\Core\Database::getRepo('XLite\Model\Cart')->findOneByProfile($auth->getProfile());
            }

            if (empty($cart)) {
                // Try to get cart from session
                $orderId = \XLite\Core\Session::getInstance()->order_id;
                if ($orderId) {
                    $cart = \XLite\Core\Database::getRepo('XLite\Model\Cart')->findOneForCustomer($orderId);

                    // Forget cart if cart is order
                    if ($cart && !$cart->hasCartStatus()) {
                        unset(\XLite\Core\Session::getInstance()->order_id, $cart);
                    }
                }
            }

            if (!isset($cart)) {
                // Cart not found - create a new instance
                $cart = new $className();
                $cart->initializeCart();

                \XLite\Core\Database::getEM()->persist($cart);
                \XLite\Core\Database::getEM()->flush();
            }

            static::$instances[$className] = $cart;

            if (
                $auth->isLogged()
                && (
                    !$cart->getProfile()
                    || $auth->getProfile()->getProfileId() != $cart->getProfile()->getProfileId()
                )
            ) {
                $cart->setProfile($auth->getProfile());
                $cart->setOrigProfile($auth->getProfile());
            }

            // Check login state
            if (
                $cart->getProfile()
                && $cart->getProfile()->getAnonymous()
                && $cart->getProfile()->getLogin()
                && is_null(\XLite\Core\Session::getInstance()->lastLoginUnique)
            ) {
                $tmpProfile = new \XLite\Model\Profile;
                $tmpProfile->setProfileId(0);
                $tmpProfile->setLogin($cart->getProfile()->getLogin());
                $profile2 = \XLite\Core\Database::getRepo('XLite\Model\Profile')->findUserWithSameLogin($tmpProfile);
                if ($profile2) {
                    \XLite\Core\Database::getEM()->detach($profile2);
                }

                \XLite\Core\Session::getInstance()->lastLoginUnique = !$profile2;
            }

            if (!$doCalculate) {
                $cart->setIgnoreLongCalculations();
            }

            if (
                !$cart->isIgnoreLongCalculations()
                && (
                    $cart instanceOf \XLite\Model\Cart
                    || ((\XLite\Core\Converter::time() - static::RENEW_PERIOD) > $cart->getLastRenewDate())
                )
            )  {
                $cart->renew();

            } else {
                $cart->calculate();
            }

            $cart->renewSoft();

            \XLite\Core\Session::getInstance()->order_id = $cart->getOrderId();
        }

        return static::$instances[$className];
    }

    /**
     * Set object instance
     *
     * @param \XLite\Model\Order $object Cart
     *
     * @return void
     */
    public static function setObject(\XLite\Model\Order $object)
    {
        $className = get_called_class();
        static::$instances[$className] = $object;
        \XLite\Core\Session::getInstance()->order_id = $object->getOrderId();
    }

    /**
     * Constructor
     *
     * @param array $data Entity properties OPTIONAL
     *
     * @return void
     */
    public function __construct(array $data = array())
    {
        // Update status of expired 'In progress' orders to 'Expired'
        \XLite\Core\Database::getRepo('XLite\Model\Order')->updateExpiredInProgressOrders();

        parent::__construct($data);
    }

    /**
     * Get ignoreLongCalculations flag value
     *
     * @return boolean
     */
    public function isIgnoreLongCalculations()
    {
        return static::$ignoreLongCalculations;
    }

    /**
     * Set ignoreLongCalculations flag value
     *
     * @return boolean
     */
    public function setIgnoreLongCalculations()
    {
        return static::$ignoreLongCalculations = true;
    }

    /**
     * Calculate order
     *
     * @return void
     */
    public function calculate()
    {
        parent::calculate();

        \XLite\Core\Session::getInstance()->lastCartInitialCalculate = \XLite\Core\Converter::time();
    }

    /**
     * Order number is assigned during the pay process
     * It must be kept during the checkout session
     *
     * @return void
     */
    public function assignOrderNumber()
    {
        if (!$this->getOrderNumber()) {
            $this->setOrderNumber(\XLite\Core\Database::getRepo('XLite\Model\Order')->findNextOrderNumber());
        }
    }

    /**
     * Calculate order with the subtotal calculation only
     *
     * @return void
     */
    public function calculateInitial()
    {
        $this->reinitializeCurrency();
    }

    /**
     * Prepare order before save data operation
     *
     * @return void
     *
     * @PrePersist
     * @PreUpdate
     */
    public function prepareBeforeSave()
    {
        parent::prepareBeforeSave();

        $this->setDate(\XLite\Core\Converter::time());
    }

    /**
     * Prepare order before create entity
     *
     * @return void
     *
     * @PrePersist
     */
    public function prepareBeforeCreate()
    {
        $this->setLastRenewDate(\XLite\Core\Converter::time());
    }

    /**
     * Clear cart
     *
     * @return void
     */
    public function clear()
    {
        foreach ($this->getItems() as $item) {
            \XLite\Core\Database::getEM()->remove($item);
        }

        $this->getItems()->clear();

        \XLite\Core\Database::getEM()->persist($this);
        \XLite\Core\Database::getEM()->flush();
    }


    /**
     * Checks whether a product is in the cart
     *
     * @param integer $productId ID of the product to look for
     *
     * @return boolean
     */
    public function isProductAdded($productId)
    {
        $result = false;

        foreach ($this->getItems() as $item) {
            $product = $item->getProduct();

            if ($product && $product->getProductId() == $productId) {
                $result = true;
                break;
            }
        }

        return $result;
    }


    /**
     * Prepare order before remove operation
     *
     * @return void
     * @PreRemove
     */
    public function prepareBeforeRemove()
    {
        parent::prepareBeforeRemove();

        unset(\XLite\Core\Session::getInstance()->order_id);
    }

    /**
     * Mark cart as order
     *
     * @return void
     */
    public function markAsOrder()
    {
        parent::markAsOrder();

        $this->getRepository()->markAsOrder($this->getOrderId());
    }

    /**
     * Check if the cart has a "Cart" status. ("in progress", "temporary")
     *
     * @return boolean
     */
    public function hasCartStatus()
    {
        return $this instanceOf \XLite\Model\Cart;
    }

    /**
     * If we can proceed with checkout with current cart
     *
     * @return boolean
     */
    public function checkCart()
    {
        return
            !$this->isEmpty()
            && !((bool) $this->getItemsWithWrongAmounts())
            && !$this->isMinOrderAmountError()
            && !$this->isMaxOrderAmountError();
    }

    /**
     * Login operation
     *
     * @param \XLite\Model\Profile $profile Profile
     *
     * @return void
     */
    public function login(\XLite\Model\Profile $profile)
    {
        if ($this->isEmpty()) {
            if ($this->getProfile() && !$this->getProfile()->getAnonymous()) {
                $this->setProfile(null);
            }

            \XLite\Core\Database::getEM()->remove($this);

        } else {
            $this->mergeWithProfile($profile);

            $this->setProfile($profile);
            $this->setOrigProfile($profile);

            \XLite\Core\Session::getInstance()->unsetBatch(
                'same_address',
                'order_create_profile',
                'createProfilePassword',
                'lastLoginUnique'
            );
        }
    }

    /**
     * Logoff operation
     *
     * @return void
     */
    public function logoff()
    {
        if (\XLite\Core\Config::getInstance()->General->logoff_clear_cart) {
            if ($this->getProfile() && !$this->getProfile()->getOrder()) {
                $this->setProfile(null);
            }
            \XLite\Core\Database::getEM()->remove($this);
        }

        \XLite\Core\Session::getInstance()->unsetBatch(
            'same_address',
            'order_id'
        );
    }

    /**
     * Initialize new cart
     *
     * @return void
     */
    protected function initializeCart()
    {
        $this->reinitializeCurrency();

        \XLite\Core\Session::getInstance()->unsetBatch(
            'same_address',
            'order_create_profile',
            'createProfilePassword'
        );
    }

    /**
     * Merge cart with with other carts specified profile
     *
     * @param \XLite\Model\Profile $profile Profile
     *
     * @return void
     */
    public function mergeWithProfile(\XLite\Model\Profile $profile)
    {
        // Merge carts
        $carts = $this->getRepository()->findByProfile($profile);

        if ($carts) {
            foreach ($carts as $cart) {
                $this->merge($cart);
                $cart->setProfile(null);
                $cart->setOrigProfile(null);
                \XLite\Core\Database::getEM()->remove($cart);
            }
        }

        // Merge old addresses
        if ($this->getProfile()) {

            // Merge shipping address
            if ($this->getProfile()->getShippingAddress() && $this->getProfile()->getShippingAddress()->getIsWork()) {
                $address = $this->getProfile()->getShippingAddress();
                if ($profile->getShippingAddress()) {
                    if ($profile->getShippingAddress()->getIsWork()) {
                        \XLite\Core\Database::getEM()->remove($profile->getShippingAddress());
                        $profile->getAddresses()->removeElement($profile->getShippingAddress());

                    } else {
                        $profile->getShippingAddress()->setisShipping(false);
                    }
                }

                $address->setProfile($profile);
                $this->getProfile()->getAddresses()->removeElement($address);
                $profile->addAddresses($address);
            }

            // Merge billing address
            if (
                $this->getProfile()->getBillingAddress()
                && $this->getProfile()->getBillingAddress()->getIsWork()
            ) {
                $address = $this->getProfile()->getBillingAddress();
                if ($profile->getBillingAddress()) {
                    if (
                        $profile->getBillingAddress()->getIsWork()
                        && !$profile->getBillingAddress()->getIsShipping()
                    ) {
                        \XLite\Core\Database::getEM()->remove($profile->getBillingAddress());
                        $profile->getAddresses()->removeElement($profile->getBillingAddress());

                    } else {
                        $profile->getBillingAddress()->setIsBilling(false);
                    }
                }

                $address->setProfile($profile);
                $this->getProfile()->getAddresses()->removeElement($address);
                $profile->addAddresses($address);
            }

        }

    }

    /**
     * Merge
     *
     * @param \XLite\Model\Cart $cart Cart
     *
     * @return \XLite\Model\Cart
     */
    public function merge(\XLite\Model\Cart $cart)
    {
        if (!$cart->isEmpty()) {
            foreach ($cart->getItems() as $item) {
                $cart->getItems()->removeElement($item);
                $item->setOrder($this);
                $this->addItems($item);
            }
        }

        return $this->updateOrder();
    }
}
