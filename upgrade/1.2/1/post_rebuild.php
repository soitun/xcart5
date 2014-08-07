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
    // Update URL to my.x-cart.com to use https protocol
    $configFile = LC_DIR_ROOT . 'etc/config.php';

    if (\Includes\Utils\FileManager::isFileWriteable($configFile)) {
        $origContent = file_get_contents($configFile);
        $newContent = str_replace('http://my.x-cart.com', 'https://my.x-cart.com', $origContent);
        if ($newContent != $origContent) {
            file_put_contents($configFile, $newContent);
        }
    }

    // Loading data to the database from yaml file
    $yamlFile = __DIR__ . LC_DS . 'post_rebuild.yaml';

    if (\Includes\Utils\FileManager::isFileReadable($yamlFile)) {
        \XLite\Core\Database::getInstance()->loadFixturesFromYaml($yamlFile);
    }

    // Change category for option 'logoff_clear_cart'
    $option = \XLite\Core\Database::getRepo('XLite\Model\Config')->findOneBy(
        array(
            'category' => 'Security',
            'name'     => 'logoff_clear_cart',
        )
    );

    // If old option exists...
    if ($option) {

        // Get the same option that could be created by translation module
        $sameOption = \XLite\Core\Database::getRepo('XLite\Model\Config')->findOneBy(
            array(
                'category' => 'General',
                'name'     => 'logoff_clear_cart',
            )
        );

        if ($sameOption) {

            // Map $option to the $sameOption
            $sameOption->setOrderby(305);
            $sameOption->setType($option->getType());
            $sameOption->setWidgetParameters($option->getWidgetParameters());
            $sameOption->setValue($option->getValue());
            $sameOption->setOptionName($option->getOptionName());
            $sameOption->setOptionComment($option->getOptionComment());

            $sameOption->update();

            // Remove old option
            \XLite\Core\Database::getEM()->remove($option);

        } else {
            // Update category and orderby
            $option->setCategory('General');
            $option->setOrderby(305);
            $option->update();
        }
    }

    // Loading data to the database from yaml file
    $yamlFile = __DIR__ . LC_DS . 'config.yaml';

    if (\Includes\Utils\FileManager::isFileReadable($yamlFile)) {
        \XLite\Core\Database::getInstance()->loadFixturesFromYaml($yamlFile);
    }

    // Common for several adjusted options categories
    $_general = array(
        'old' => 'General',
        'new' => 'Units',
    );

    // Adjusted settings
    $settings = array(
        'weight_unit'    => $_general,
        'weight_symbol'  => $_general,
        'thousand_delim' => $_general,
        'decimal_delim'  => $_general,
        'date_format'    => $_general,
        'time_format'    => $_general,
        'time_zone'      => $_general,
        'terms_url'      => array(
            'old' => 'Company',
            'new' => 'General',
        ),
        'shop_closed'    => array(
            'old' => 'General',
            'new' => 'Internal',
        ),
        'shop_closed'    => array(
            'old' => '',
            'new' => 'Internal',
        ),
    );

    // Change value of new options from the old ones
    foreach ($settings as $name => $data) {

        $options = \XLite\Core\Database::getRepo('XLite\Model\Config')->findBy(array('name' => $name));
        $value = null;
        $index = null;
        $oldIndex = null;

        foreach ($options as $i => $option) {

            if ($option->getCategory() == $data['old']) {
                $value = $option->getValue();
                $oldIndex = $i;

            } elseif ($option->getCategory() == $data['new']) {
                $index = $i;
            }
        }

        // Replace new option's value from the old option
        if (isset($index) && isset($value)) {
            $options[$index]->setValue($value);
        }

        // Remove old option
        if (isset($oldIndex)) {
            \XLite\Core\Database::getEM()->remove($options[$oldIndex]);
        }
    }

    // Remove obsolete options
    $removedOptions = array(
        'unit_presentation',
        'operation_presentation',
        'check_templates_status',
        'form_id_protection',
        'last_date',
        'proxy',
    );

    foreach ($removedOptions as $name) {
        $options = \XLite\Core\Database::getRepo('XLite\Model\Config')->findBy(array('name' => $name));
        if ($options) {
            foreach ($options as $o) {
                \XLite\Core\Database::getEM()->remove($o);
            }
        }
    }

    // Remove {{WEB_LC_ROOT}} from category descriptions

    $categories = \XLite\Core\Database::getRepo('XLite\Model\Category')->findAll();

    if ($categories) {
        foreach ($categories as $c) {
            $tr = $c->getTranslations();
            foreach ($tr as $t) {
                $t->description = str_replace('{{WEB_LC_ROOT}}', '', $t->description);
            }
        }
    }

    \XLite\Core\Database::getEM()->flush();
    \XLite\Core\Database::getCacheDriver()->deleteAll();
};
