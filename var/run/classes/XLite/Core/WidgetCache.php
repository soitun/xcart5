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
 * Widget cache 
 */
class WidgetCache extends \XLite\Base\Singleton
{
    /**
     * Widget cache prefix
     */
    const CACHE_PREFIX = 'viewCache.';

    const REGISTRY_CELL = 'viewCacheRegistry';

    /**
     * Enable (cache)
     * 
     * @var   boolean
     */
    protected $enableCache;

    /**
     * Check - cache is enabled or not
     * 
     * @return boolean
     */
    public function isEnabled()
    {
        if (!isset($this->enableCache)) {
            $this->enableCache = \XLite\Core\Config::getInstance()->Performance->use_view_cache;
        }

        return $this->enableCache;
    }

    /**
     * Delete all 
     * 
     * @return void
     */
    public function deleteAll()
    {
        foreach (array_keys($this->fetchRegistry()) as $key) {
            \XLite\Core\Database::getCacheDriver()->delete($key);
        }

        $this->saveRegistry(array());
    }

    /**
     * Delete by partial key
     *
     * @param array $parameters Cache cell keys
     *
     * @return void
     */
    public function delete(array $parameters)
    {
        $registry = $this->fetchRegistry();

        foreach ($this->getRegistryKey($parameters) as $key) {
            \XLite\Core\Database::getCacheDriver()->delete($key);
            unset($registry[$key]);
        }

        $this->saveRegistry($registry);
    }

    /**
     * Get cache
     *
     * @param array $parameters Cache cell keys
     *
     * @return string
     */
    public function get(array $parameters)
    {
        $content = \XLite\Core\Database::getCacheDriver()->fetch($this->getCacheKey($parameters));

        return is_string($content) ? $content : null;
    }

    /**
     * Set cache
     * 
     * @param array   $parameters Cache cell keys
     * @param string  $content    Content
     * @param integer $ttl        TTL (seconds) OPTIONAL
     *  
     * @return void
     */
    public function set(array $parameters, $content, $ttl = \XLite\Model\Repo\ARepo::CACHE_DEFAULT_TTL)
    {
        $key = $this->getCacheKey($parameters);
        $ttl = $ttl ?: \XLite\Model\Repo\ARepo::CACHE_DEFAULT_TTL;

        $this->setRegistry($key, $parameters);

        \XLite\Core\Database::getCacheDriver()->save($key, $content, $ttl);
    }

    /**
     * Remove cache
     *
     * @param array $parameters Cache cell keys
     *
     * @return string
     */
    public function remove(array $parameters)
    {
        $key = $this->getCacheKey($parameters);

        \XLite\Core\Database::getCacheDriver()->delete($key);
        $this->unsetRegistry($key);
    }

    /**
     * Get cache key
     *
     * @param array $parameters Parameters OPTIONAL
     *
     * @return string
     */
    protected function getCacheKey(array $parameters = array())
    {
        return static::CACHE_PREFIX . implode('.', $parameters);
    }

    // {{{ Registry

    /**
     * Set registry 
     * 
     * @param string $key        String-key
     * @param array  $parameters Cache cell keys
     *  
     * @return void
     */
    protected function setRegistry($key, array $parameters)
    {
        $registry = $this->fetchRegistry();

        $registry[$key] = $parameters;

        $this->saveRegistry($registry);
    }

    /**
     * Remove registry cell
     * 
     * @param string $key Key
     *  
     * @return void
     */
    protected function unsetRegistry($key)
    {
        $registry = $this->fetchRegistry();

        if (isset($registry[$key])) {
            unset($registry[$key]);
        }

        $this->saveRegistry($registry);
    }

    /**
     * Get registry key 
     * 
     * @param array $parameters Cache cell keys (partial)
     *  
     * @return array
     */
    protected function getRegistryKey(array $parameters)
    {
        $registry = $this->fetchRegistry();

        $result = array();

        $keys = array();
        foreach ($keys as $k => $v) {
            if (is_null($v)) {
                unset($keys[$k]);
            }
        }

        foreach ($registry as $key => $parameters) {
            $found = true;
            foreach ($keys as $i => $value) {
                if (!isset($parameters[$i]) || $parameters[$i] != $value) {
                    $found = false;
                    break;
                }
            }

            if ($found) {
                $result[] = $key;
            }
        }

        return $result;
    }

    /**
     * Fetch registry 
     * 
     * @return array
     */
    protected function fetchRegistry()
    {
        $registry = @unserialize(\XLite\Core\Database::getCacheDriver()->fetch(static::REGISTRY_CELL));
        if (!is_array($registry)) {
            $registry = array();
        }

        return is_array($registry) ? $registry : array();
    }

    /**
     * Save registry 
     * 
     * @param array $registry Registry
     *  
     * @return void
     */
    protected function saveRegistry(array $registry)
    {
        \XLite\Core\Database::getCacheDriver()->save(static::REGISTRY_CELL, serialize($registry));
    }

    // }}}
}

