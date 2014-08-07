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

    \XLite\Core\Translation::getInstance()->reset();

    // Removing obsolete options

    $options = array(
        array(
            'name'     => 'logoff_clear_cart',
            'category' => 'General',
        )
    );

    foreach ($options as $opt) {
        $option = \XLite\Core\Database::getRepo('XLite\Model\Config')->findOneBy($opt);

        if (isset($option)) {
            \XLite\Core\Database::getRepo('XLite\Model\Config')->delete($option);
        }
    }

    $yamlFile = LC_DIR_VAR . 'temporary.categories.yaml';

    if (file_exists($yamlFile)) {
        $data = \Includes\Utils\Operator::loadServiceYAML($yamlFile);
        if ($data) {
            if ($data['memberships']) {
                foreach ($data['memberships'] as $cid => $mid) {
                    $category = \XLite\Core\Database::getRepo('XLite\Model\Category')->find($cid);
                    $membership = \XLite\Core\Database::getRepo('XLite\Model\Membership')->find($mid);
                    if ($category->getCategoryId() && $membership->getMembershipId()) {
                        $category->addMemberships($membership);
                        $membership->addCategory($category);
                    }
                }
                \XLite\Core\Database::getEM()->flush();
            }
        }
        \XLite\Core\Database::getCacheDriver()->deleteAll();

        \Includes\Utils\FileManager::deleteFile($yamlFile);
    }

    // Patch .htaccess file

    $htaccessFile = LC_DIR_ROOT . '.htaccess';

    if (\Includes\Utils\FileManager::isExists($htaccessFile) && \Includes\Utils\FileManager::isWriteable($htaccessFile)) {
    
        $htaccess = file_get_contents($htaccessFile);
        $htaccessOrig = $htaccess;

        $from = 'RewriteRule(.*)cart.php.*';
        $to = 'RewriteRule ^((([/_a-z0-9-]+)/)?([_a-z0-9-]+)/)?([_a-z0-9-]+)(\.(htm)(l)?)?\$ cart.php?url=\$5&last=\$4&rest=\$3&ext=\$7 [NC,L,QSA]';

        $htaccess = preg_replace('/' . $from . '/', $to, $htaccess);

        $from = <<<OUT

# Deflating several main types of content
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/xml application/x-javascript application/xhtml+xml application/rss+xml
</IfModule>

OUT;

        $from = preg_replace('/(\n|\r)/USm', '\\s', preg_quote($from, '/'));

        $htaccess = preg_replace('/' . $from . '/USm', '', $htaccess);

        if ($htaccessOrig != $htaccess) {
            file_put_contents($htaccessFile, $htaccess);
        }
    }
};
