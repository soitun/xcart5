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

namespace XLite\Module\CDev\SocialLogin\Core;

/**
 * Authorization routine
 */
abstract class Auth extends \XLite\Core\AuthAbstract implements \XLite\Base\IDecorator
{
    /**
     * Logs in user to cart
     *
     * @param string $login      User's login
     * @param string $password   User's password
     * @param string $secureHash Secret token OPTIONAL
     *
     * @return \XLite\Model\Profile|integer
     */
    public function login($login, $password, $secureHash = null)
    {
        $profile = \XLite\Core\Database::getRepo('XLite\Model\Profile')->findOneBy(
            array('login' => $login, 'order' => null)
        );

        if ($profile && $profile->isSocialProfile()) {
            $result = static::RESULT_ACCESS_DENIED;
        }

        return isset($result) ? $result : parent::login($login, $password, $secureHash);
    }
}
