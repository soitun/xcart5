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
    // Loading data to the database from yaml file
    $yamlFile = __DIR__ . LC_DS . 'post_rebuild.yaml';

    if (\Includes\Utils\FileManager::isFileReadable($yamlFile)) {
        \XLite\Core\Database::getInstance()->loadFixturesFromYaml($yamlFile);
    }

    // Import profile addresses from the temporary YAML file storage
    $yamlProfileStorageFile = LC_DIR_VAR . 'temporary.storage.profiles.yaml';

    if (file_exists($yamlProfileStorageFile)) {
        $addresses = \Includes\Utils\Operator::loadServiceYAML($yamlProfileStorageFile);
    }

    if (!empty($addresses)) {

        foreach ($addresses as $address) {

            $entity = \XLite\Core\Database::getRepo('XLite\Model\Address')
                ->findOneBy(array(
                    'address_id' => $address['address_id'],
                    'profile'    => $address['profile_id'],
                    )
                );

            $entity->setProfile(\XLite\Core\Database::getRepo('XLite\Model\Profile')->find($address['profile_id']));
            $entity->setCountry(\XLite\Core\Database::getRepo('XLite\Model\Country')->findOneByCode($address['country_code']));
            $entity->setState(\XLite\Core\Database::getRepo('XLite\Model\State')->find($address['state_id']));

            unset($address['profile_id'], $address['state_id'], $address['country_code']);
            $entity->map($address);

            $entity->update();
            \XLite\Core\Database::getEM()->flush($entity);
        }
    }

    \Includes\Utils\FileManager::deleteFile($yamlProfileStorageFile);

};
