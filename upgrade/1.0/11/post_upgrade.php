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
    // Update tables structure to avoid categories and products images loss
    $prefix = \XLite\Core\Database::getInstance()->getTablePrefix();

    $queries = array(
        "ALTER TABLE `{$prefix}category_images` DROP FOREIGN KEY `{$prefix}category_images_ibfk_1`;",
        "ALTER TABLE `{$prefix}category_images` CHANGE `id` `category_id` int(10) unsigned DEFAULT NULL;",
        "ALTER TABLE `{$prefix}category_images` CHANGE `image_id` `id` int(10) unsigned NOT NULL AUTO_INCREMENT;",
        "ALTER TABLE `{$prefix}product_images` DROP FOREIGN KEY `{$prefix}product_images_ibfk_1`;",
        "ALTER TABLE `{$prefix}product_images` CHANGE `id` `product_id` int(10) unsigned DEFAULT NULL;",
        "ALTER TABLE `{$prefix}product_images` CHANGE `image_id` `id` int(10) unsigned NOT NULL AUTO_INCREMENT;",
    );

    foreach ($queries as $query) {
        \Includes\Utils\Database::execute($query);
    }
};
