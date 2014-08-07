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
    // Update data for table of languages

    $tablePrefix = \XLite::getInstance()->getOptions(array('database_details', 'table_prefix'));

    $data = array(
        'product_translations' => array(
            'brief_description' => array('briefDescription', 'longtext NOT NULL'),
            'meta_tags'         => array('metaTags', 'varchar(255) NOT NULL'),
            'meta_desc'         => array('metaDesc', 'longtext NOT NULL'),
            'meta_title'        => array('metaTitle', 'varchar(255) NOT NULL'),
        ),
        'category_translations' => array(
            'meta_tags'         => array('metaTags', 'varchar(255) NOT NULL'),
            'meta_desc'         => array('metaDesc', 'longtext NOT NULL'),
            'meta_title'        => array('metaTitle', 'varchar(255) NOT NULL'),
        ),
    );

    $queries = array();

    foreach ($data as $table => $columns) {

        $tableName = $tablePrefix . $table;

        $tableColumns = \XLite\Core\Database::getEM()->getConnection()->getSchemaManager()->listTableColumns($tableName);

        foreach ($columns as $old => $new) {

            if (isset($tableColumns[$old]) && !isset($tableColumns[$new[0]])) {
                $queries[] = 'ALTER TABLE ' . $tableName . ' ADD COLUMN ' . $new[0] . ' ' . $new[1];
                $queries[] = 'UPDATE ' . $tableName . ' SET ' . $new[0] . ' = ' . $old;
            }
        }
    }

    foreach ($queries as $query) {
        \XLite\Core\Database::getEM()->getConnection()->executeQuery($query, array());
    }
};
