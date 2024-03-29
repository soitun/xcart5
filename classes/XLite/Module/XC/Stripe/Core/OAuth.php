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

namespace XLite\Module\XC\Stripe\Core;

/**
 * OAuth 
 */
class OAuth extends \XLite\Base\Singleton
{
    /**
     * URL state 
     * 
     * @var string
     */
    protected $urlState;

    /**
     * Get client id 
     * 
     * @return string
     */
    public function getClientId()
    {
        return 'ca_3M7dbaBh8wZ4nvntmkUHLl3xIbjQufNf';
    }

    /**
     * Get client secret API key (test)
     * 
     * @return string
     */
    public function getClientSecretTest()
    {
        return 'sk_test_CcfXfezqHefCJ2qh8rs82AB4';
    }

    /**
     * Get client secret API key (live)
     *
     * @return string
     */
    public function getClientSecretLive()
    {
        return 'sk_live_7yFrfTJXgiPBbju8TrXp2kej';
    }

    /**
     * Get redirect URI 
     * 
     * @return string
     */
    public function getRedirectURI()
    {
        return \XLite::getInstance()->getShopURL(\XLite\Core\Converter::buildURL('stripe_oauth'));
    }

    // {{{ OAuth rquests

    /**
     * Authorize 
     * 
     * @param \XLite\Model\Payment\Method $method Payment method
     * @param string                      $code   OAuth code
     *  
     * @return array
     */
    public function authorize(\XLite\Model\Payment\Method $method, $code)
    {
        $request = $this->getHTTPRequester('oauth/token');
        $data = $this->setupOAuthTokenRequest($request, $method, $code)->sendRequest();
        $data = json_decode($data);

        if (!empty($data->access_token)) {
            $this->saveSettings($method, $data);
            $result = array(true, null);

        } elseif (!empty($data->error)) {
            $result = array(false, $data->error_description);
        }

        return $result;
    }

    /**
     * Refresh token 
     * 
     * @param \XLite\Model\Payment\Method $method Payment method
     *  
     * @return array
     */
    public function refreshToken(\XLite\Model\Payment\Method $method)
    {
        $request = $this->getHTTPRequester('oauth/token');
        $data = $this->setupOAuthTokenRefreshRequest($request, $method)->sendRequest();
        $data = json_decode($data);

        if (!empty($data->access_token)) {
            $this->saveSettings($method, $data, false);
            $result = array(true, null);

        } elseif (!empty($data->error)) {
            $result = array(false, $data->error_description);
        }

        return $result;
    }

    /**
     * Get HTTP requester
     *
     * @return \XLite\Core\HTTP\Request
     */
    protected function getHTTPRequester($path)
    {
        return new \XLite\Core\HTTP\Request('https://connect.stripe.com/' . $path);
    }

    /**
     * Setup HTTP requester for oauth/token request
     *
     * @param \XLite\Core\HTTP\Request    $request Requester
     * @param \XLite\Model\Payment\Method $method  Payment method
     * @param string                      $code    Code
     *
     * @return \XLite\Core\HTTP\Request
     */
    protected function setupOAuthTokenRequest(\XLite\Core\HTTP\Request $request, \XLite\Model\Payment\Method $method, $code)
    {
        $request->verb = 'POST';
        $request->body = array(
            'client_secret' => $method->getProcessor()->getActualClientSecret($method),
            'code'          => $code,
            'grant_type'    => 'authorization_code',
        );
        $request->setHeader('Accept', 'application/json');

        return $request;
    }

    /**
     * Setup HTTP requester for oauth/token request (refresh token)
     *
     * @param \XLite\Core\HTTP\Request    $request Requester
     * @param \XLite\Model\Payment\Method $method  Payment method
     *
     * @return \XLite\Core\HTTP\Request
     */
    protected function setupOAuthTokenRefreshRequest(\XLite\Core\HTTP\Request $request, \XLite\Model\Payment\Method $method)
    {
        $request->verb = 'POST';
        $request->body = array(
            'client_secret' => $method->getProcessor()->getActualClientSecret($method),
            'refresh_token' => $method->getSetting('refreshToken'),
            'grant_type'    => 'refresh_token',
        );
        $request->setHeader('Accept', 'application/json');

        return $request;
    }

    /**
     * Save settings 
     * 
     * @param \XLite\Model\Payment\Method $method   Payment method
     * @param object                      $data     OAuth response
     * @param boolean                     $saveFull Save full data flag OPTIONAL
     *  
     * @return void
     */
    protected function saveSettings(\XLite\Model\Payment\Method $method, $data, $saveFull = true)
    {
        $prefix = $method->getProcessor()->isTestMode($method) ? 'Test' : 'Live';
        $method->setSetting('accessToken' . $prefix, $data->access_token);
        $method->setSetting('publishKey' . $prefix, $data->stripe_publishable_key);

        if ($saveFull) {
            $method->setSetting('refreshToken', $data->refresh_token);
            $method->setSetting('userId', $data->stripe_user_id);
        }
    }

    // }}}

    // {{{ Service

    /**
     * Generate and get URL state 
     * 
     * @return string
     */
    public function generateURLState()
    {
        if (!isset($this->urlState)) {
            $this->urlState = $this->defineURLState();
        }

        return $this->getRedirectURI() . '|' . $this->urlState;
    }

    /**
     * Define URL state 
     * 
     * @return string
     */
    public function defineURLState()
    {
        return hash_hmac(
            'sha512',
            \XLite\Core\Auth::getInstance()->getProfile()->getLogin(),
            'stripe'
        );
    }

    // }}}

}

