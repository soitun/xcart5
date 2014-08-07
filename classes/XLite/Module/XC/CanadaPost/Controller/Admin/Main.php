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

namespace XLite\Module\XC\CanadaPost\Controller\Admin;

/**
 * Main page controller
 */
class Main extends \XLite\Controller\Admin\Main implements \XLite\Base\IDecorator
{
    /**
     * ACTION: default action
     *
     * @return void
     */
    protected function doNoAction()
    {
        if (
            isset(\XLite\Core\Request::getInstance()->{'token-id'})
            && isset(\XLite\Core\Request::getInstance()->{'registration-status'})
        ) {
            $this->capostValidateMerchant();
        }

        parent::doNoAction();
    }
    
    /**
     * Validate return from Canada Post merchant registration process
     *
     * @return void
     */
    protected function capostValidateMerchant()
    {
        $token = \XLite\Core\Request::getInstance()->{'token-id'};
        $status = \XLite\Core\Request::getInstance()->{'registration-status'};

        if (\XLite\Module\XC\CanadaPost\Core\Service\Platforms::REG_STATUS_SUCCESS == $status) {
            
            // Registration is complete
            
            // Send request to Canada Post server to retrive merchant details
            $data = \XLite\Module\XC\CanadaPost\Core\Service\Platforms::getInstance()
                ->callGetMerchantRegistrationInfoByToken($token);

            if (isset($data->merchantInfo)) {
                
                // Update Canada Post settings
                $this->updateCapostMerchantSettings($data->merchantInfo);

                // Disable wizard
                $this->disableCapostWizard();

                \XLite\Core\TopMessage::getInstance()->addInfo('Registration process has been completed successfully.');

            } else {

                foreach ($data->errors as $err) {
                    \XLite\Core\TopMessage::getInstance()->addError('ERROR: [' . $err->code . '] ' . $err->description);
                }
            }

        } else {

            // An error occurred

            if (\XLite\Module\XC\CanadaPost\Core\Service\Platforms::REG_STATUS_CANCELLED == $status) {

                \XLite\Core\TopMessage::getInstance()->addError('Registration process has been canceled.');

            } else {
                
                \XLite\Core\TopMessage::getInstance()->addError('Failure to finish regustration process.');
            }
        }

        // Remove token from the session
        \XLite\Core\Session::getInstance()->capost_token_id = null;
        \XLite\Core\Session::getInstance()->capost_token_ts = null;
        
        // Redirect back to the Canada Post settings page
        $this->setReturnURL($this->buildURL('capost'));
    }
    
    /**
     * Disable Canada Post merchant registration wizard
     *
     * @return void
     */
    protected function disableCapostWizard()
    {
        $option = \XLite\Core\Database::getRepo('XLite\Model\Config')
            ->findOneBy(array('name' => 'wizard_enabled', 'category' => 'XC\CanadaPost'));

        $option->setValue('N');

        \XLite\Core\Database::getEM()->persist($option);

        \XLite\Core\Database::getEM()->flush();
    }
    
    /**
     * Update Canada Post merchant settings
     *
     * @param \XLite\Core\CommonCell $data Merchant new data
     *
     * @return void
     */
    protected function updateCapostMerchantSettings($data)
    {
        $optionsMap = array(
            'customer_number' => 'customerNumber',
            'contract_id'     => 'contractNumber',
            'user'            => 'merchantUsername',
            'password'        => 'merchantPassword',
            'quote_type'      => 'quoteType',
            'wizard_hash'     => 'wizardHash',
        );

        $data->wizardHash = md5($data->merchantUsername . ':' . $data->merchantPassword);
        
        // Determine quote type
        $data->quoteType = (isset($data->contractNumber))
            ? \XLite\Module\XC\CanadaPost\Core\API::QUOTE_TYPE_CONTRACTED
            : \XLite\Module\XC\CanadaPost\Core\API::QUOTE_TYPE_NON_CONTRACTED;

        $options = \XLite\Core\Database::getRepo('\XLite\Model\Config')
            ->findBy(array('category' => 'XC\CanadaPost', 'name' => array_keys($optionsMap)));

        foreach ($options as $k => $o) {
            
            $field = $optionsMap[$o->getName()];

            $o->setValue((isset($data->{$field})) ? $data->{$field} : '');
            
            \XLite\Core\Database::getEM()->persist($o);
        }

        \XLite\Core\Database::getEM()->flush();
    }
}
