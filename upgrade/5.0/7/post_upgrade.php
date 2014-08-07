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
    // Update default values for the fields which has Doctrine type 'array'

    $tablePrefix = \XLite::getInstance()->getOptions(array('database_details', 'table_prefix'));

    $columns = array(
        'modules' => array(
            'tags',
            'editions',
        ),
        'module_keys' => array(
            'keyData',
        ),
    );

    $defaultValue = serialize(array());

    $queries = array();

    foreach ($columns as $table => $fields) {

        $tableName = $tablePrefix . $table;
    
        $tableColumns = \XLite\Core\Database::getEM()->getConnection()->getSchemaManager()->listTableColumns($tableName);

        $updateFields = array();

        foreach ($fields as $field) {

            if (!isset($tableColumns[$field])) {
                $queries[] = 'ALTER TABLE ' . $tableName . ' ADD COLUMN ' . $field . ' longtext NOT NULL COMMENT \'(DC2Type:array)\'';
            }
    
            $queries[] = 'UPDATE ' . $tableName . ' SET ' . $field . ' = "' . $defaultValue . '" WHERE ' . $field . ' = ""';
        }
    }

    foreach ($queries as $query) {
        \XLite\Core\Database::getEM()->getConnection()->executeQuery($query, array());
    }

    // Update data for table of languages

    $tableName = $tablePrefix . 'languages';
    $tableColumns = \XLite\Core\Database::getEM()->getConnection()->getSchemaManager()->listTableColumns($tableName);

    if (isset($tableColumns['status']) && !isset($tableColumns['added']) && !isset($tableColumns['enabled'])) {

        $queries = array();

        $queries[] = 'ALTER TABLE ' . $tableName . ' ADD COLUMN added tinyint(1) unsigned NOT NULL';
        $queries[] = 'ALTER TABLE ' . $tableName . ' ADD COLUMN enabled tinyint(1) unsigned NOT NULL';

        $queries[] = 'UPDATE ' . $tableName . ' SET added = IF(status>0, 1, 0), enabled = IF(status=2,1,0)';

        foreach ($queries as $query) {
            \XLite\Core\Database::getEM()->getConnection()->executeQuery($query, array());
        }
    }
};
