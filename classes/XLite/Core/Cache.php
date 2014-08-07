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

namespace XLite\Core;

/**
 * Cache decorator
 */
class Cache extends \XLite\Base
{
    /**
     * Cache driver
     *
     * @var \Doctrine\Common\Cache\Cache
     */
    protected $driver;

    /**
     * Constructor
     *
     * @param \Doctrine\Common\Cache\Cache $driver Driver OPTIONAL
     *
     * @return void
     */
    public function __construct(\Doctrine\Common\Cache\Cache $driver = null)
    {
        $this->driver = $driver ?: $this->detectDriver();
    }

    /**
     * Get driver 
     * 
     * @return \Doctrine\Common\Cache\Cache
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Call driver's method
     *
     * @param string $name      Method name
     * @param array  $arguments Arguments OPTIONAL
     *
     * @return mixed
     */
    public function __call($name, array $arguments = array())
    {
        return call_user_func_array(array($this->driver, $name), $arguments);
    }

    /**
     * Get cache driver by options list
     *
     * @return \Doctrine\Common\Cache\Cache
     */
    protected function detectDriver()
    {
        $options = \XLite::getInstance()->getOptions('cache');

        if (empty($options) || !is_array($options) || !isset($options['type'])) {
            $options = array('type' => null);
        }

        // Auto-detection
        if ('auto' == $options['type']) {

            foreach (static::$cacheDriversQuery as $type) {
                $method = 'detectCacheDriver' . ucfirst($type);

                // $method assembled from 'detectCacheDriver' + $type
                if (static::$method()) {
                    $options['type'] = $type;
                    break;
                }
            }
        }

        if ('apc' == $options['type']) {

            // APC
            $cache = new \Doctrine\Common\Cache\ApcCache;

        } elseif ('memcache' == $options['type'] && isset($options['servers']) && class_exists('Memcache', false)) {

            // Memcache
            $servers = explode(';', $options['servers']) ?: array('localhost');
            if ($servers) {
                $memcache = new \Memcache();
                foreach ($servers as $row) {
                    $row = trim($row);
                    $tmp = explode(':', $row, 2);
                    if ('unix' == $tmp[0]) {
                        $memcache->addServer($row, 0);

                    } elseif (isset($tmp[1])) {
                        $memcache->addServer($tmp[0], $tmp[1]);

                    } else {
                        $memcache->addServer($tmp[0]);
                    }
                }

                $cache = new \Doctrine\Common\Cache\MemcacheCache;
                $cache->setMemcache($memcache);
            }

        } elseif ('xcache' == $options['type']) {

            $cache = new \Doctrine\Common\Cache\XcacheCache;

        } else {

            // Default cache - file system cache
            $cache = new \XLite\Core\FileCache(LC_DIR_DATACACHE);
            if (!$cache->isValid()) {
                $cache = null;
            }

        }

        if (!$cache) {
            $cache = new \Doctrine\Common\Cache\ArrayCache();
        }

        if (!empty($options['namespace'])) {
            $cache->setNamespace($options['namespace']);
        }

        return $cache;
    }

}
