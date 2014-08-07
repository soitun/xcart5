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
    // OrderItem model has been changed
    $prefix = \XLite\Core\Database::getInstance()->getTablePrefix();

    $queries = array(
        "ALTER TABLE `{$prefix}order_items` ADD COLUMN `itemNetPrice` decimal(14,4) NOT NULL;",
        "ALTER TABLE `{$prefix}order_items` ADD COLUMN `discountedSubtotal` decimal(14,4) NOT NULL;",
        "UPDATE `{$prefix}order_items` SET `itemNetPrice`=`netPrice`, `discountedSubtotal`=`netPrice`*`amount`;",
        "ALTER TABLE `{$prefix}order_items` DROP COLUMN `netPrice`;",
    );

    foreach ($queries as $query) {
        \Includes\Utils\Database::execute($query);
    }

    // 'No fractional part' item has been removed from 'Currency decimal separator' option
    if ('' == \XLite\Core\Config::getInstance()->General->decimal_delim) {
        \XLite\Core\Database::getRepo('\XLite\Model\Config')->createOption(
            array(
                'category' => 'General',
                'name'     => 'decimal_delim',
                'value'    => '.'
            )
        );
    }
};
