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

namespace Includes;

/**
 * Autoloader
 *
 */
abstract class Autoloader
{
    /**
     * List of registered autoload functions
     *
     * @var array
     */
    protected static $functions = array(
        '__lc_autoload',
        '__lc_autoload_includes',
    );

    /**
     * The directory where LC classes are located
     *
     * @var string
     */
    protected static $lcAutoloadDir = LC_DIR_CACHE_CLASSES;

    /**
     * Main autoloader checking procedure.
     * Work for the inner XC classes only
     *
     * @param string $class name of the class to load
     *
     * @return void
     */
    public static function checkAutoload($class)
    {
        /**
         * NOTE: it's the PHP bug: in some cases it adds or removes the leading slash. Examples:
         *
         * 1. For static call "\Includes\Decorator\Utils\CacheManager::rebuildCache()" it will remove
         * the leading slash, and class name passed in this function will be "Includes\Decorator\Utils\CacheManager".
         *
         * 2. Pass class name as a string into the functions, e.g.
         * "is_subclass_of($object, '\Includes\Decorator\Utils\CacheManager')". Then the class
         * name will be passed into the autoloader with the leading slash - "\Includes\Decorator\Utils\CacheManager"
         *
         * Remove the "ltrim()" call when this issue will be resolved
         *
         * May be that issue is related: http://bugs.php.net/50731
         */
        $class = ltrim($class, '\\');
        list($prefix) = explode('\\', $class, 2);
        $result = false;

        // Workaround for Doctrine 2 proxies
        if (
            ($prefix === LC_NAMESPACE || $prefix === LC_NAMESPACE . 'Abstract')
            && false === strpos($class, \Doctrine\Common\Persistence\Proxy::MARKER)
        ) {
            $result = file_exists(static::$lcAutoloadDir . str_replace('\\', LC_DS, $class) . '.php');
        }

        return $result;
    }

    /**
     * Main LC autoloader
     *
     * @param string $class name of the class to load
     *
     * @return void
     */
    public static function __lc_autoload($class)
    {
        /**
         * NOTE: it's the PHP bug: in some cases it adds or removes the leading slash. Examples:
         *
         * 1. For static call "\Includes\Decorator\Utils\CacheManager::rebuildCache()" it will remove
         * the leading slash, and class name passed in this function will be "Includes\Decorator\Utils\CacheManager".
         *
         * 2. Pass class name as a string into the functions, e.g.
         * "is_subclass_of($object, '\Includes\Decorator\Utils\CacheManager')". Then the class
         * name will be passed into the autoloader with the leading slash - "\Includes\Decorator\Utils\CacheManager"
         *
         * Remove the "ltrim()" call when this issue will be resolved
         *
         * May be that issue is related: http://bugs.php.net/50731
         */
        $class = ltrim($class, '\\');
        list($prefix) = explode('\\', $class, 2);

        // Workaround for Doctrine 2 proxies
        if (
            ($prefix === LC_NAMESPACE || $prefix === LC_NAMESPACE . 'Abstract')
            && false === strpos($class, \Doctrine\Common\Persistence\Proxy::MARKER)
        ) {
            include_once (static::$lcAutoloadDir . str_replace('\\', LC_DS, $class) . '.php');
        }
    }

    /**
     * Autoloader for the "includes"
     *
     * @param string $class name of the class to load
     *
     * @return void
     */
    public static function __lc_autoload_includes($class)
    {
        $class = ltrim($class, '\\');

        if (0 === strpos($class, LC_NAMESPACE_INCLUDES)) {
            include_once (LC_DIR_ROOT . str_replace('\\', LC_DS, $class) . '.php');
        }
    }

    /**
     * Add an autoload function to the list
     *
     * @param string $method function name
     *
     * @return void
     */
    public static function addFunction($method)
    {
        if (false !== array_search($method, static::$functions)) {
            throw new \Exception('Autoload function "' . $method . '" is already registered');
        }

        static::$functions[] = $method;

        spl_autoload_register(array('static', $method));
    }

    /**
     * Register autoload functions
     *
     * @return void
     */
    public static function registerAll()
    {
        foreach (static::$functions as $method) {
            spl_autoload_register(array('static', $method));
        }

        // Doctrine
        static::registerDoctrineAutoloader();

        // PEAR2
        static::registerPEARAutolader();

        // Load code cache
        static::loadCodeCache();

        // Load lessphp
        static::loadLESSPhp();
    }

    /**
     * Register the autoload function for the custom library
     *
     * @param string $namespace Root library namespace
     * @param string $path      Library path OPTIONAL
     *
     * @return void
     */
    public static function registerCustom($namespace, $path = LC_DIR_LIB)
    {
        require_once (LC_DIR_LIB . 'Doctrine' . LC_DS . 'Common' . LC_DS . 'ClassLoader.php');

        $loader = new \Doctrine\Common\ClassLoader($namespace, rtrim($path, LC_DS));
        $loader->register();
    }

    /**
     * Register the autoload function for the Doctrine library
     *
     * @return void
     */
    protected static function registerDoctrineAutoloader()
    {
        static::registerCustom('Doctrine');
        static::registerCustom('Symfony');
        static::registerCustom('Rah');

        // Proxy classes autoloader
        \Doctrine\ORM\Proxy\Autoloader::register(rtrim(LC_DIR_CACHE_PROXY, LC_DS), LC_MODEL_PROXY_NS);
    }

    /**
     * Autoloader for PEAR2
     *
     * @return void
     */
    protected static function registerPEARAutolader()
    {
        require_once (LC_DIR_LIB . 'PEAR2' . LC_DS . 'Autoload.php');
    }

    /**
     * Load code cache
     *
     * @return void
     */
    protected static function loadCodeCache()
    {
        if (!defined('LC_CACHE_BUILDING')) {
            $path = LC_DIR_CACHE_CLASSES . 'core.php';
            if (file_exists($path)) {
                require_once ($path);
                define('LC_CACHE_LOADED', true);
            }
        }
    }

    /**
     * Load lessphp
     *
     * @return void
     */
    protected static function loadLESSPhp()
    {
        require_once (LC_DIR_LIB . 'Less' . LC_DS . 'Less.php');
    }

    /**
     * Switch autoload directory from var/run/classes/ to classes/
     *
     * @param string $dir New autoload directory
     *
     * @return void
     */
    public static function switchLCAutoloadDir()
    {
        static::$lcAutoloadDir = LC_DIR_CLASSES;
    }

    /**
     * Return path ot the autoloader current dir
     *
     * @return string
     */
    public static function getLCAutoloadDir()
    {
        return static::$lcAutoloadDir;
    }
}
