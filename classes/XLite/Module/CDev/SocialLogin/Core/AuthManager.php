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
 * Maintains the list of auth providers
 */
class AuthManager extends \XLite\Base
{
    /**
     * Get all available authentication providers instances
     *
     * @return array List of auth provider objects (\XLite\Module\CDev\SocialLogin\Core\AAuthProvider descendants)
     */
    public static function getAuthProviders()
    {
        return array_filter(
            array_map(
                function ($className) {
                    return $className::getInstance();
                },
                static::getAuthProvidersClassNames()
            ),
            function ($provider) {
                return $provider->isConfigured();
            }
        );
    }

    /**
     * Get all available authentication providers class names
     *
     * @return array List of auth provider class names (\XLite\Module\CDev\SocialLogin\Core\AAuthProvider descendants)
     */
    protected static function getAuthProvidersClassNames()
    {
        return array(
            '\XLite\Module\CDev\SocialLogin\Core\FacebookAuthProvider',
            '\XLite\Module\CDev\SocialLogin\Core\GoogleAuthProvider',
        );
    }
}
