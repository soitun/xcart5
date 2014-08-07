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

namespace XLite\View;

/**
 * Resources container routine
 */
abstract class AResourcesContainer extends \XLite\View\Container
{

    /**
     * Latest cache timestamp
     *
     * @var   integer
     */
    public static $latestCacheTimestamp;

    /**
     * Return cache dir path for resources
     *
     * @param array $params
     *
     * @return string
     */
    public static function getResourceCacheDir(array $params)
    {
        return LC_DIR_CACHE_RESOURCES . implode(LC_DS, $params). LC_DS;
    }

    /**
     * Return CSS resources structure from the file cache
     *
     * @param array $resources
     *
     * @return array
     */
    public function getCSSResourceFromCache(array $resources)
    {
        return $this->getResourceFromCache(
            static::RESOURCE_CSS,
            $resources,
            array(
                static::RESOURCE_CSS,
                \XLite\Core\Request::getInstance()->isHTTPS() ? 'https' : 'http',
                $resources[0]['media'],
            ),
            'prepareCSSCache'
        ) + array('media' => $resources[0]['media']);
    }

    /**
     * Return latest time stamp of cache build procedure
     *
     * @return integer
     */
    protected static function getLatestCacheTimestamp()
    {
        if (!isset(\XLite\View\AResourcesContainer::$latestCacheTimestamp)) {
            \XLite\View\AResourcesContainer::$latestCacheTimestamp = intval(
                \XLite\Core\Database::getRepo('XLite\Model\TmpVar')->getVar(\XLite::CACHE_TIMESTAMP)
            );
        }

        return \XLite\View\AResourcesContainer::$latestCacheTimestamp;
    }

    /**
     * Return JS resources structure from the file cache
     *
     * @param array $resources
     *
     * @return array
     */
    protected function getJSResourceFromCache(array $resources)
    {
        return $this->getResourceFromCache(static::RESOURCE_JS, $resources, array(static::RESOURCE_JS), 'prepareJSCache');
    }

    /**
     * Return resource structure from the file cache
     *
     * @param string $type                   File type of resource (js/css)
     * @param array  $resources              Resources for caching
     * @param array  $paramsForCache         Parameters of file cache (directory structure path to file)
     * @param string $prepareCacheFileMethod Method of $this object to read one resource entity and do some inner work if it is necessary
     *
     * @return array
     */
    protected function getResourceFromCache($type, array $resources, array $paramsForCache, $prepareCacheFileMethod)
    {
        $pathToCacheDir = static::getResourceCacheDir($paramsForCache);
        \Includes\Utils\FileManager::mkdirRecursive($pathToCacheDir);

        $file = hash('sha256', serialize($resources)) . '.' . $type;
        $filePath = $pathToCacheDir . $file;

        if (!\Includes\Utils\FileManager::isFile($filePath)) {
            foreach ($resources as $resource) {
                \Includes\Utils\FileManager::write($filePath, $this->$prepareCacheFileMethod($resource['file']), FILE_APPEND);
            }
        }

        return array(
            'file' => $filePath,
            'url'  => \XLite::getInstance()
                ->getShopURL(
                    str_replace(LC_DS, '/', substr($filePath, strlen(LC_DIR_ROOT))),
                    \XLite\Core\Request::getInstance()->isHTTPS()
                ),
        );
    }

    /**
     * Prepares CSS cache to use. Main issue - replace url($resourcePath) construction with url($shopUrl/$resourcePath)
     *
     * @param string $filePath CSS cache file path
     *
     * @return string
     */
    protected function prepareCSSCache($filePath)
    {
        $data = \Includes\Utils\FileManager::read($filePath);

        $container = $this;
        $filePrefix = str_replace(LC_DS, '/', dirname(substr($filePath, strlen(LC_DIR_ROOT)))) . '/';
        $data = preg_replace_callback(
            '/url\(([^)]+)\)/Ss',
            function (array $matches) use ($container, $filePrefix) {
                return $container->processCSSURLHandler($matches, $filePrefix);
            },
            $data
        );

        return PHP_EOL
            . '/***** AUTOGENERATED: ' . basename($filePath) . ' */' . PHP_EOL
            . $data;
    }

    /**
     * Process CSS URL callback
     *
     * @param array  $mathes     Matches
     * @param string $filePrefix File prefix
     *
     * @return string
     */
    public function processCSSURLHandler(array $mathes, $filePrefix)
    {
        $url = trim($mathes[1]);

        if (!preg_match('/^[\'"]?data:/Ss', $url)) {
            $first = substr($url, 0, 1);

            if ('"' == $first || '\'' == $first) {
                $url = stripslashes(substr($url, 1, -1));
            }

            if (!preg_match('/^(?:https?:)?\/\//Ss', $url)) {
                if ('/' != substr($url, 0, 1)) {
                    $url = $filePrefix . $url;
                }

                $url = \Includes\Utils\URLManager::getProtoRelativeShopURL($url);
            }


            if (preg_match('/[\'"]/Ss', $url)) {
                $url = '"' . addslashes($url) . '"';
            }
        }

        return 'url(' . $url . ')';
    }

    /**
     * Prepares CSS cache to use
     *
     * @param string $filePath JS cache file path
     *
     * @return string
     */
    protected function prepareJSCache($filePath)
    {
        return "\r\n" . '/***** AUTOGENERATED: ' . basename($filePath) . ' */' . "\r\n" . \Includes\Utils\FileManager::read($filePath);
    }

    /**
     * Check if the CSS resources should be aggregated
     *
     * @return boolean
     */
    protected function doCSSAggregation()
    {
        return \XLite\Core\Config::getInstance()->Performance->aggregate_css;
    }

    /**
     * Check if the JS resources should be aggregated
     *
     * @return boolean
     */
    protected function doJSAggregation()
    {
        return \XLite\Core\Config::getInstance()->Performance->aggregate_js;
    }

    /**
     * Add specific unique identificator to resource URL
     *
     * @param string $url
     *
     * @return string
     */
    protected function getResourceURL($url)
    {
        return $url . '?' . static::getLatestCacheTimestamp();
    }

    /**
     * Get collected javascript resources
     *
     * @return array
     */
    protected function getJSResources()
    {
        return \XLite\Core\Layout::getInstance()->getPreparedResourcesByType(static::RESOURCE_JS);
    }

    /**
     * Get collected CSS resources
     *
     * @return array
     */
    protected function getCSSResources()
    {
        return \XLite\Core\Layout::getInstance()->getPreparedResourcesByType(static::RESOURCE_CSS);
    }

    /**
     * Resources must be grouped if the outer CSS or JS resource is used
     * For example:
     * array(
     *      controller.js,
     *      button.js,
     *      http://google.com/script.js,
     *      tail.js
     * )
     *
     * is grouped into:
     *
     * array(
     *      array(
     *          controller.js,
     *          button.js,
     *      ),
     *      array(http://google.com/script.js),
     *      array(
     *          tail.js
     *      )
     * )
     *
     * Then the local resources are cached according $cacheHandler method.
     *
     * @param array  $resources    Resources array
     * @param atring $cacheHandler Cache handler method
     *
     * @return array
     */
    public function groupResourcesByUrl($resources, $cacheHandler)
    {
        $groupByUrl = array();
        $group = array();

        foreach ($resources as $info) {
            $urlData = parse_url($info['url']);

            if (isset($urlData['host'])) {
                $groupByUrl = array_merge(
                    $groupByUrl,
                    empty($group) ? array() : array($this->$cacheHandler($group)),
                    array($info)
                );

                $group = array();
            } else {
                $group[] = $info;
            }
        }

        return array_merge($groupByUrl, empty($group) ? array() : array($this->$cacheHandler($group)));
    }

    /**
     * Get collected JS resources
     *
     * @return array
     */
    protected function getAggregateJSResources()
    {
        return $this->groupResourcesByUrl($this->getJSResources(), 'getJSResourceFromCache');
    }

    /**
     * Get collected CSS resources
     *
     * @return array
     */
    protected function getAggregateCSSResources()
    {
        $list = $this->getCSSResources();

        // Group CSS resources by media type
        $groupByMedia = array();
        $group = array();

        $elem = array_shift($list);
        $index = 100;
        $groupByMedia[$index][] = $elem;
        $currentMedia = $elem['media'];

        foreach ($list as $fileInfo) {
            if ($currentMedia !== $fileInfo['media']) {
                $index += 100;
                $currentMedia = $fileInfo['media'];
            }

            $groupByMedia[$index][] = $fileInfo;
        }

        $list = array();
        foreach ($groupByMedia as $group) {
            $list = array_merge($list, $this->groupResourcesByUrl($group, 'getCSSResourceFromCache'));
        }

        return $list;
    }

    /**
     * Return default template
     *
     * @return string
     */
    protected function getDefaultTemplate()
    {
        return $this->getDir() . '/body.tpl';
    }
}
