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
    foreach (\XLite\Core\Database::getRepo('XLite\Module\CDev\SimpleCMS\Model\Menu')->findAll() as $menu) {
        $menu->setVisibleFor('AL');
    }
    \XLite\Core\Database::getEM()->flush();

    $yamlFile = __DIR__ . LC_DS . 'post_rebuild.yaml';

    $cnd = new \XLite\Core\CommonCell;
    $cnd->type = \XLite\Module\CDev\SimpleCMS\Model\Menu::MENU_TYPE_PRIMARY;

    if (
        0 == \XLite\Core\Database::getRepo('XLite\Module\CDev\SimpleCMS\Model\Menu')->search($cnd, true)
        && \Includes\Utils\FileManager::isFileReadable($yamlFile)
    ) {
        \XLite\Core\Database::getInstance()->loadFixturesFromYaml($yamlFile);
    }

    /**
     * Move the logo and favicon images to another place (to "<shop_root_catalog>/")
     */
    $oldDir = LC_DIR_SKINS . \XLite\Core\Layout::PATH_COMMON . LC_DS;
    $newDir = LC_DIR . LC_DS;
    foreach(array('logo', 'favicon') as $imageType) {
        $image = \XLite\Core\Config::getInstance()->CDev->SimpleCMS->{$imageType};
        \Includes\Utils\FileManager::move($oldDir . $image, $newDir . $image);
    }
};
