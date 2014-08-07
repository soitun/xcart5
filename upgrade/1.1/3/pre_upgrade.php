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

return function()
{
    // Store the profiles into the temporary YAML file
    \Includes\Utils\Operator::saveServiceYAML(
        LC_DIR_VAR . 'temporary.storage.profiles.yaml',
        array_map(
            function ($address) {
                return array(
                    'address_id'    => $address->getAddressId(),
                    'profile_id'    => $address->getProfile()->getProfileId(),
                    'title'         => $address->getTitle(),
                    'firstname'     => $address->getFirstname(),
                    'lastname'      => $address->getLastname(),
                    'phone'         => $address->getPhone(),
                    'street'        => $address->getStreet(),
                    'city'          => $address->getCity(),
                    'state_id'      => $address->getState()->getStateId(),
                    'custom_state'  => $address->getCustomState(),
                    'country_code'  => $address->getCountry()->getCode(),
                    'zipcode'       => $address->getZipcode(),
                );
            },
            \XLite\Core\Database::getRepo('XLite\Model\Address')->findAll()
        )
    );
};
