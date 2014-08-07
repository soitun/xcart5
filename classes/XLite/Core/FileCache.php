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

namespace XLite\Core;

/**
 * File system cache
 * FIXME: must be completely refactored
 */
class FileCache extends \Doctrine\Common\Cache\CacheProvider
{
    /**
     * Cache directory path
     *
     * @var string
     */
    protected $path = null;

    /**
     * File header
     *
     * @var string
     */
    protected $header = '<?php die(); ?>';

    /**
     * File header length
     *
     * @var integer
     */
    protected $headerLength = 15;

    /**
     * TTL block length
     *
     * @var integer
     */
    protected $ttlLength = 11;

    /**
     * Validation cache
     *
     * @var array
     */
    protected $validationCache = array();

    /**
     * Namespace
     *
     * @var string
     */
    protected $_namespace;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct($path = null)
    {
        $this->setPath($path ? $path : sys_get_temp_dir());
    }

    /**
     * Check - cache provider is valid or not
     *
     * @return boolean
     */
    public function isValid()
    {
        return (bool)$this->getPath();
    }

    /**
     * Set cache path
     *
     * @param string $path Path
     *
     * @return void
     */
    public function setPath($path)
    {
        if (is_string($path)) {
            if (!file_exists($path)) {
                \Includes\Utils\FileManager::mkdirRecursive($path);
            }

            if (file_exists($path) && is_dir($path) && is_writable($path)) {
                $this->path = $path;
            }
        }
    }

    /**
     * Get cache path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * getNamespacedId
     *
     * @param string $id ____param_comment____
     *
     * @return string
     */
    protected function getNamespacedId($id)
    {
        $namespaceCacheKey = sprintf(static::DOCTRINE_NAMESPACE_CACHEKEY, $this->getNamespace());
        $namespaceVersion  = ($this->doContains($namespaceCacheKey)) ? $this->doFetch($namespaceCacheKey) : 1;

        return sprintf('%s[%s][%s]', $this->getNamespace(), $id, $namespaceVersion);
    }

    /**
     * getNamespacedId
     *
     * @param string $id ____param_comment____
     *
     * @return string
     */
    protected function getNamespacedIdToDelete($id)
    {
        $namespaceCacheKey = sprintf(static::DOCTRINE_NAMESPACE_CACHEKEY, $this->getNamespace());
        $namespaceVersion  = ($this->doContains($namespaceCacheKey)) ? $this->doFetch($namespaceCacheKey) : 1;

        return sprintf('%s[%s*', $this->getNamespace(), $id, $namespaceVersion);
    }


    /**
     * Get cache cell by id
     *
     * @param string $id CEll id
     *
     * @return mixed
     */
    protected function doFetch($id)
    {
        $path = $this->getPathById($id);

        $result = false;

        if (file_exists($path) && $this->isKeyValid($path)) {
            $result = unserialize(file_get_contents($path, false, null, $this->headerLength + $this->ttlLength));
        }

        return $result;
    }

    /**
     * Check - repository has cell with specified id or not
     *
     * @param string $id CEll id
     *
     * @return boolean
     */
    protected function doContains($id)
    {
        $path = $this->getPathById($id);

        return file_exists($path) && $this->isKeyValid($path);
    }

    /**
     * Save cell data
     *
     * @param string  $id       Cell id
     * @param mixed   $data     Cell data
     * @param integer $lifeTime Cell TTL OPTIONAL
     *
     * @return boolean
     */
    protected function doSave($id, $data, $lifeTime = 0)
    {
        $lifeTime = strval(min(0, intval($lifeTime)));

        return \Includes\Utils\FileManager::write(
            $this->getPathById($id),
            $this->header . str_repeat(' ', $this->ttlLength - strlen($lifeTime)) . $lifeTime . serialize($data)
        );
    }

    /**
     * Delete cell
     *
     * @param string $id Cell id
     *
     * @return boolean
     */
    protected function doDelete($id)
    {
        $path = $this->getPathById($id);

        $result = false;

        if (file_exists($path)) {
            $result = @unlink($path);
        }

        return $result;
    }

    /**
     * doFlush
     *
     * @return boolean
     */
    protected function doFlush()
    {
        return true;
    }

    /**
     * doGetStats
     *
     * @return array
     */
    protected function doGetStats()
    {
        return array();
    }

    /**
     * Get cell path by cell id
     *
     * @param string $id Cell id
     *
     * @return string
     */
    protected function getPathById($id)
    {
        return $this->path . LC_DS . str_replace(array('\\', '..', LC_DS), '_', $id) . '.php';
    }

    /**
     * Check - cell file is valid or not
     *
     * @param string $path CEll file path
     *
     * @return boolean
     */
    protected function isKeyValid($path)
    {
        if (!isset($this->validationCache[$path]) || !$this->validationCache[$path]) {

            $result = true;

            $ttl = intval(file_get_contents($path, false, null, $this->headerLength, $this->ttlLength));

            if (0 < $ttl && \XLite\Core\Converter::time() > $ttl) {
                unlink($path);
                $result = false;
            }

            $this->validationCache[$path] = $result;
        }

        return $this->validationCache[$path];
    }
}
