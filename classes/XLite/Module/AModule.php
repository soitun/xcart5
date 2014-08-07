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
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

namespace XLite\Module;

/**
 * Module
 */
abstract class AModule
{
    /**
     * Keys for  moveClassesInLists and moveTemplatesInLists methods
     */
    const TO_DELETE = 'to_delete';
    const TO_ADD    = 'to_add';

    /**
     * Method to initialize concrete module instance
     *
     * @return void
     */
    public static function init()
    {
        // Register skins into Layout
        static::registerSkins();
    }

    /**
     * Decorator run this method at the end of cache rebuild
     *
     * @return void
     */
    public static function runBuildCacheHandler()
    {
        static::registerPermissions();

        static::manageClasses();
        static::manageTemplates();
    }

    /**
     * Method to call just before the module is uninstalled (totally remove) via core
     *
     * @return void
     */
    public static function callUninstallEvent()
    {
        // TODO: Check if it is to remove
        //static::removePermissions();
    }

    /**
     * Method to call just before the module is disabled via core
     *
     * @return void
     */
    public static function callDisableEvent()
    {
        static::unregisterPermissions();
    }

    /**
     * Return module name
     *
     * @return string
     */
    public static function getModuleName()
    {
        \Includes\ErrorHandler::fireErrorAbstractMethodCall(__METHOD__);
    }

    /**
     * Return author full name
     *
     * @return string
     */
    public static function getAuthorName()
    {
        \Includes\ErrorHandler::fireErrorAbstractMethodCall(__METHOD__);
    }

    /**
     * Return module description
     *
     * @return string
     */
    public static function getDescription()
    {
        \Includes\ErrorHandler::fireErrorAbstractMethodCall(__METHOD__);
    }

    /**
     * Return URL for module icon
     *
     * @return string
     */
    public static function getIconURL()
    {
        list($author, $name) = explode(
            '\\',
            \Includes\Utils\ModulesManager::getModuleNameByClassName(get_called_class())
        );

        $path = \Includes\Utils\ModulesManager::getModuleIconFile($author, $name);
        $url  = '';

        if (\Includes\Utils\FileManager::isFileReadable($path)) {
            $url = \Includes\Utils\Converter::buildURL(
                'module',
                null,
                array(
                    'author' => $author,
                    'name'   => $name,
                ),
                'image.php'
            );
        }

        return $url;
    }

    /**
     * Return link to the module author page
     *
     * @return string
     */
    public static function getAuthorPageURL()
    {
        return '';
    }

    /**
     * Return link to the module page
     *
     * @return string
     */
    public static function getPageURL()
    {
        return '';
    }

    /**
     * Determines if we need to show settings form link
     *
     * @return boolean
     */
    public static function showSettingsForm()
    {
        return false;
    }

    /**
     * Return link to settings form
     *
     * @return string
     */
    public static function getSettingsForm()
    {
        return null;
    }

    /**
     * Return module dependencies
     *
     * @return array
     */
    public static function getDependencies()
    {
        return array();
    }

    /**
     * Return list of mutually exclusive modules
     *
     * @return array
     */
    public static function getMutualModulesList()
    {
        return array();
    }

    /**
     * Get module major version
     *
     * @return string
     */
    public static function getMajorVersion()
    {
        return \XLite::getInstance()->getMajorVersion();
    }

    /**
     * Get minor core version which is required for the module activation
     *
     * @return string
     */
    public static function getMinorRequiredCoreVersion()
    {
        return '0';
    }

    /**
     * Get module minor version
     *
     * @return string
     */
    public static function getMinorVersion()
    {
        \Includes\ErrorHandler::fireErrorAbstractMethodCall(__METHOD__);
    }

    /**
     * Get module version
     *
     * @return string
     */
    public static function getVersion()
    {
        return \Includes\Utils\Converter::composeVersion(static::getMajorVersion(), static::getMinorVersion());
    }

    /**
     * Return true if module is 'system module' and admin cannot disable/uninstall and view this module in the modules list
     *
     * @return boolean
     */
    public static function isSystem()
    {
        return false;
    }

    /**
     * Get the module skins list to register in layout.
     * The array has the following format:
     *
     * return array(
     *  <interface_name> => array(
     *  <skin_short_path1>,
     * ...
     * ),
     * ...
     * )
     *
     * Interface in this list:
     *
     * \XLite::ADMIN_INTERFACE
     * \XLite::CONSOLE_INTERFACE
     * \XLite::COMMON_INTERFACE
     * \XLite::MAIL_INTERFACE
     * \XLite::CUSTOMER_INTERFACE
     *
     * <skin_short_path> - Relative skin path inside the LC_DIR_SKINS directory:
     *
     * For directory `<application_dir>/skins/my_module_skin` short path value will be 'my_module_skin'
     *
     * @return array
     */
    public static function getSkins()
    {
        return array();
    }

    /**
     * You can define some special conditions to register or not your own skins (defined in static::getSkins() method)
     *
     * By default the TRUE condition is defined
     *
     * @see static::getSkins()
     * @see static::registerSkins()
     *
     * @return boolean
     */
    public static function doRegisterSkins()
    {
        return true;
    }

    /**
     * Skins registration method.
     * Do not change it until you are not sure.
     *
     * @return void
     */
    public static function registerSkins()
    {
        if (static::doRegisterSkins()) {
            foreach (static::getSkins() as $interface => $skinsToRegister) {
                foreach ($skinsToRegister as $skin) {
                    static::registerSkin($skin, $interface);
                }
            }
        }
    }

    /**
     * Make one skin entry registration to provide a flexible skin registration
     *
     * @param string $skin
     * @param string $interface
     */
    public static function registerSkin($skin, $interface)
    {
        \XLite\Core\Layout::getInstance()->addSkin($skin, $interface);
    }

    /**
     * Use this method when your module must register some user permissions.
     * Data contains pairs permission_code => permission_name
     * permission_name is the permission name in English
     *
     * For example:
     *
     * return array(
     *      'manage my own permission' => 'Manage my own permission',
     *      'manage another actions'   => 'Manage another actions',
     * )
     *
     * @return array
     */
    public static function getPermissions()
    {
        return array();
    }

    /**
     * Get list of core permissions
     *
     * @return array
     */
    public static function getCorePermissions()
    {
        return array(
            'root access'    => 'Root access',
            'manage catalog' => 'Manage catalog',
            'manage users'   => 'Manage users',
            'manage orders'  => 'Manage orders',
            'manage import'  => 'Manage import',
            'manage export'  => 'Manage export',
        );
    }

    /**
     * Permission registration routine.
     * It is called after the cache rebuilding procedure
     * if the module is enabled
     *
     * @return void
     */
    protected static function registerPermissions()
    {
        foreach (static::getPermissions() as $permissionCode => $permissionName) {
            static::registerPermission($permissionCode, $permissionName);
        }
    }

    /**
     * Permission unregistration routine.
     * It is called during the "callDisableEvent" event after the module is disabled
     * but before the cache rebuilding procedure.
     *
     * @return void
     */
    protected static function unregisterPermissions()
    {
        foreach (static::getPermissions() as $permissionCode => $permissionName) {
            static::unregisterPermission($permissionCode);
        }
    }

    /**
     * One entry permission registration
     * It is called in static::registerPermissions() method
     *
     * @param string $permissionCode
     * @param string $permissionName
     */
    protected static function registerPermission($permissionCode, $permissionName)
    {
    }

    /**
     * One entry permission unregistration
     * It is called in static::unregisterPermissions() method
     *
     * @param string $permissionCode
     */
    protected static function unregisterPermission($permissionCode)
    {
    }

    /**
     * TODO: Check if it is to remove
     */
    protected static function removePermissions()
    {
        foreach (static::getPermissions() as $permissionCode => $permissionName) {
            static::removePermission($permissionCode);
        }
    }

    /**
     * Move viewers method registers widgets for moving or removing between the lists
     * The module must provide the array of records with the following formats:
     *
     * array(
     *   '\XLite\View\Field' => array(      // Name of the viewer class
     *      array('from_list', 'admin'),    // From list "from_list" and "admin" zone
     *      array('to_list', '10', 'admin') // To list "to_list" with weight = 10 and zone = "admin"
     *   ),
     *   '\XLite\View\Field' => array(
     *      'from_list',                    // From list "from_list"
     *      array('to_list', '10', 'admin') // To list "to_list" with weight = 10 and zone = "admin"
     *   ),
     *   '\XLite\View\Field' => array(
     *      'from_list',                    // From list "from_list"
     *      'to_list'                       // To list "to_list" , with default parameters
     *   ),
     *   '\XLite\View\Field' => array(
     *      array('from_list2', 'admin'),   // Remove from list "from_list2" and "admin" zone
     *   ),
     *   '\XLite\View\Field' => array(
     *      'from_list',                    // Remove from list "from_list"
     *   ),
     * )
     *
     * If you need to add or remove several entries you can use the static::TO_DELETE and static::TO_ADD keys:
     *
     * '\XLite\View\Field1' => array(
     *      static::TO_DELETE => array(
     *          array('product.inventory.parts1', \XLite\Model\ViewList::INTERFACE_ADMIN),
     *          array('product.inventory.parts2', \XLite\Model\ViewList::INTERFACE_ADMIN),
     *      ),
     *      static::TO_ADD => array(
     *          array('product.inventory.parts3', \XLite\Model\ViewList::INTERFACE_ADMIN),
     *          array('product.inventory.parts4', \XLite\Model\ViewList::INTERFACE_ADMIN),
     *      ),
     * ),
     * '\XLite\View\Field2' => array(
     *      static::TO_DELETE => array(
     *          array('product.inventory.parts', \XLite\Model\ViewList::INTERFACE_ADMIN),
     *      ),
     * )
     *
     * If the TO_DELETE/TO_ADD keys are used the other info will not be considered
     *
     * @return array
     */
    protected static function moveClassesInLists()
    {
        return array();
    }

    /**
     * Move templates method registers templates for moving or removing between the lists
     * The module must provide the array of records with the following formats:
     *
     * array(
     *   'field/body.tpl' => array(         // Name of the template
     *      array('from_list', 'admin'),    // From list "from_list" and "admin" zone
     *      array('to_list', '10', 'admin') // To list "to_list" with weight = 10 and zone = "admin"
     *   ),
     *   'field/body.tpl' => array(
     *      'from_list',                    // From list "from_list"
     *      array('to_list', '10', 'admin') // To list "to_list" with weight = 10 and zone = "admin"
     *   ),
     *   'field/body.tpl' => array(
     *      'from_list',                    // From list "from_list"
     *      'to_list'                       // To list "to_list" , with default parameters
     *   ),
     *   'field/body.tpl' => array(
     *      array('from_list2', 'admin'),   // Remove from list "from_list2" and "admin" zone
     *   ),
     *   'field/body.tpl' => array(
     *      'from_list',                    // Remove from list "from_list"
     *   ),
     * )
     *
     * If you need to add or remove several entries you can use the static::TO_DELETE and static::TO_ADD keys:
     *
     * 'product/inventory/inv_track_amount.tpl' => array(
     *      static::TO_DELETE => array(
     *          array('product.inventory.parts1', \XLite\Model\ViewList::INTERFACE_ADMIN),
     *          array('product.inventory.parts2', \XLite\Model\ViewList::INTERFACE_ADMIN),
     *      ),
     *      static::TO_ADD => array(
     *          array('product.inventory.parts3', \XLite\Model\ViewList::INTERFACE_ADMIN),
     *          array('product.inventory.parts4', \XLite\Model\ViewList::INTERFACE_ADMIN),
     *      ),
     * ),
     * 'product/inventory/inv_track_selector.tpl' => array(
     *      static::TO_DELETE => array(
     *          array('product.inventory.parts', \XLite\Model\ViewList::INTERFACE_ADMIN),
     *      ),
     * )
     *
     * If the TO_DELETE/TO_ADD keys are used the other info will not be considered
     *
     * @return array
     */
    protected static function moveTemplatesInLists()
    {
        return array();
    }

    /**
     * Common management method to move/remove widgets
     *
     * @param string $getter        Getter routine
     * @param string $removeRoutine Method name of the layout to remove the widgets from lists
     * @param string $addRoutine    Method name of the layout to add the widgets to lists
     */
    protected static function manageWidgets($getter, $removeRoutine, $addRoutine)
    {
        $layout = \XLite\Core\Layout::getInstance();
        foreach (call_user_func('static::' . $getter) as $name => $params) {
            $toSet = array();
            $fromSet = array();

            if (isset($params[static::TO_ADD]) || isset($params[static::TO_DELETE])) {
                $fromSet = isset($params[static::TO_DELETE]) ? $params[static::TO_DELETE] : array();
                $toSet = isset($params[static::TO_ADD]) ? $params[static::TO_ADD] : array();
            } else if (count($params) === 1) {
                // Remove case
                $fromSet = array(is_array($params[0]) ? $params[0] : array($params[0]));
            } else {
                // Move widgets case
                $fromSet = array(is_array($params[0]) ? $params[0] : array($params[0]));
                $toSet = array(is_array($params[1]) ? $params[1] : array($params[1]));
            }

            foreach ($fromSet as $from) {
                $layout->{$removeRoutine}($name, $from[0], isset($from[1]) ? $from[1] : null);
            }

            foreach ($toSet as $to) {
                $toParams = array();
                if (isset($to[1])) {
                    $toParams['weight'] = $to[1];
                }

                if (isset($to[2])) {
                    $toParams['zone'] = $to[2];
                }

                $layout->{$addRoutine}($name, $to[0], $toParams);
            }
        }
    }

    /**
     * Manage viewer classes routine
     *
     * @return void
     */
    protected static function manageClasses()
    {
        static::manageWidgets('moveClassesInLists', 'removeClassFromList', 'addClassToList');
    }

    /**
     * Manage templates routine
     *
     * @return void
     */
    protected static function manageTemplates()
    {
        static::manageWidgets('moveTemplatesInLists', 'removeTemplateFromList', 'addTemplateToList');
    }
}
