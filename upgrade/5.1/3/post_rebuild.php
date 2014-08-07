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
    $yamlFile = __DIR__ . LC_DS . 'post_rebuild.yaml';

    if (\Includes\Utils\FileManager::isFileReadable($yamlFile)) {
        \XLite\Core\Database::getInstance()->loadFixturesFromYaml($yamlFile);
    }

    // Remove unnecessary core version variable stored in the inner config
    $coreVersion = \XLite\Core\Database::getRepo('XLite\Model\Config')->findOneBy(
        array(
            'category' => 'Internal',
            'name'     => 'coreVersionBeforeUpgrade',
        )
    );

    if ($coreVersion) {
        \XLite\Core\Database::getRepo('XLite\Model\Config')->delete($coreVersion);
    }

    // Create option 'default_products_sort_order' if not exists
    $option = \XLite\Core\Database::getRepo('XLite\Model\Config')->findOneBy(
        array(
            'category' => 'General',
            'name'     => 'default_products_sort_order',
        )
    );

    if (!$option || !$option->value) {
        $path = LC_DIR_ROOT . 'sql/xlite_data.yaml';
        $data = \Symfony\Component\Yaml\Yaml::parse($path);

        if ($data && $data['XLite\\Model\\Config']) {
            $rows = array();
            foreach ($data['XLite\\Model\\Config'] as $key => $value) {
                if (
                    !empty($value['name']) && 'default_products_sort_order' == $value['name']
                    && !empty($value['category']) && 'General' == $value['category']
                ) {
                    $rows[] = $value;
                }
            }

            if ($rows) {
                \XLite\Core\Database::getRepo('XLite\Model\Config')->loadFixtures($rows);
                \XLite\Core\Database::getEM()->flush();
                \XLite\Core\Database::getEM()->clear();
            }
        }
    }

};
