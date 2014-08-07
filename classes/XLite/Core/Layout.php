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
 * Layout manager
 */
class Layout extends \XLite\Base\Singleton
{
    /**
     * Repository paths
     */
    const PATH_SKIN     = 'skins';
    const PATH_CUSTOMER = 'default';
    const PATH_COMMON   = 'common';
    const PATH_ADMIN    = 'admin';
    const PATH_CONSOLE  = 'console';
    const PATH_MAIL     = 'mail';

    /**
     * Web URL output types
     */
    const WEB_PATH_OUTPUT_SHORT = 'sort';
    const WEB_PATH_OUTPUT_FULL  = 'full';
    const WEB_PATH_OUTPUT_URL   = 'url';

    /**
     * Widgets resources collector
     *
     * @var array
     */
    protected $resources = array();

    /**
     * Preapre resouces flag
     *
     * @var boolean
     */
    protected $prepareResourcesFlag = false;

    /**
     * Current skin
     *
     * @var string
     */
    protected $skin;

    /**
     * Current locale
     *
     * @var string
     */
    protected $locale;

    /**
     * Current skin path
     *
     * @var string
     */
    protected $path;

    /**
     * Current interface
     *
     * @var string
     */
    protected $currentInterface = \XLite::CUSTOMER_INTERFACE;

    /**
     * Main interface of mail.
     * For example body.tpl of mail is inside MAIL interface
     * but the inner widgets and templates in this template are inside CUSTOMER or ADMIN interfaces
     *
     * @var string
     */
    protected $mailInterface = \XLite::CUSTOMER_INTERFACE;

    /**
     * Skins list
     *
     * @var array
     */
    protected $skins = array();

    /**
     * Skin paths
     *
     * @var array
     */
    protected $skinPaths = array();

    /**
     * Resources cache
     *
     * @var array
     */
    protected $resourcesCache = array();

    /**
     * Skins cache flag
     *
     * @var boolean
     */
    protected $skinsCache = false;

    // {{{ Layout changers methods

    /**
     * The modules can use the method in the last step of classes rebuilding.
     * The module removes the viewer class list location via this method.
     *
     * For example:
     *
     * \XLite\Core\Layout::getInstance()->removeClassFromList(
     *    'XLite\Module\CDev\Bestsellers\View\Bestsellers'
     * );
     *
     * After the classes rebuilding the bestsellers block is removed
     * from any list in the store
     *
     * @param string $class Name of class to remove
     *
     * @see \XLite\Module\AModule::runBuildCacheHandler()
     */
    public function removeClassFromLists($class)
    {
        $data = array(
            'child' => $class,
        );

        $this->removeFromList($data);
    }

    /**
     * The modules can use the method in the last step of classes rebuilding.
     * The module removes the viewer class list location via this method.
     *
     * For example:
     *
     * \XLite\Core\Layout::getInstance()->removeClassFromList(
     *    'XLite\Module\CDev\Bestsellers\View\Bestsellers',
     *    'sidebar.first',
     *    \XLite\Model\ViewList::INTERFACE_CUSTOMER
     * );
     *
     * After the classes rebuilding the bestsellers block is removed
     * from 'sidebar.first' list in customer interface
     *
     * @param string $class    Name of class to remove
     * @param string $listName List name where the class was located
     * @param string $zone     Interface where the list is located   OPTIONAL
     *
     * @see \XLite\Module\AModule::runBuildCacheHandler()
     */
    public function removeClassFromList($class, $listName, $zone = null)
    {
        $data = array(
            'child' => $class,
            'list'  => $listName,
        );

        if (!is_null($zone)) {
            $data['zone'] = $zone;
        }

        $this->removeFromList($data);
    }

    /**
     * The modules can use the method in the last step of classes rebuilding.
     * The module adds the viewer class list location via this method.
     *
     * Options array contains other info that must be added to the viewList entry.
     * \XLite\Model\ViewList entry contains `weight` and `zone` parameters
     *
     * For example:
     *
     * \XLite\Core\Layout::getInstance()->addClassToList(
     *    'XLite\Module\CDev\Bestsellers\View\Bestsellers',
     *    'sidebar.second',
     *    array(
     *        'zone'   => \XLite\Model\ViewList::INTERFACE_CUSTOMER,
     *        'weight' => 100,
     *    )
     * );
     *
     * If any module decorates \XLite\Model\ViewList class and adds any other info
     * you can insert additional information via $options parameter
     *
     * @param string $class    Class name WITHOUT leading `\`
     * @param string $listName Name of the list where the class must be located
     * @param array  $options  Additional info to add to the viewList entry
     *
     * @return \XLite\Model\ViewList New entry of the viewList
     *
     * @see \XLite\Model\ViewList
     * @see \XLite\Module\AModule::runBuildCacheHandler()
     */
    public function addClassToList($class, $listName, $options = array())
    {
        return $this->addToList(array_merge(array(
            'child' => $class,
            'list' => $listName,
        ), $options));
    }

    /**
     * The modules can use the method in the last step of classes rebuilding.
     * The module removes the template from any lists via this method.
     *
     * For example:
     *
     * \XLite\Core\Layout::getInstance()->removeTemplateFromList(
     *    'product\details\parts\common.button-add2cart.tpl'
     * );
     *
     * After the classes rebuilding the add to cart block is removed
     * from any list in any interface
     *
     * @param string $tpl Name of template to remove
     *
     * @see \XLite\Module\AModule::runBuildCacheHandler()
     */
    public function removeTemplateFromLists($tpl)
    {
        $data = array(
            'tpl'   => $this->prepareTemplateToList($tpl),
        );

        $this->removeFromList($data);
    }

    /**
     * The modules can use the method in the last step of classes rebuilding.
     * The module removes the template list location via this method.
     *
     * For example:
     *
     * \XLite\Core\Layout::getInstance()->removeTemplateFromList(
     *    'product\details\parts\common.button-add2cart.tpl',
     *    'product.details.page.info.buttons.cart-buttons',
     *    \XLite\Model\ViewList::INTERFACE_CUSTOMER
     * );
     *
     * After the classes rebuilding the add to cart block is removed
     * from 'product.details.page.info.buttons.cart-buttons' list in customer interface
     *
     * @param string $tpl      Name of template to remove
     * @param string $listName List name where the class was located
     * @param string $zone     Interface where the list is located   OPTIONAL
     *
     * @see \XLite\Module\AModule::runBuildCacheHandler()
     */
    public function removeTemplateFromList($tpl, $listName, $zone = null)
    {
        $data = array(
            'tpl'   => $this->prepareTemplateToList($tpl),
            'list'  => $listName,
        );

        if (!is_null($zone)) {
            $data['zone'] = $zone;
        }

        $this->removeFromList($data);
    }

    /**
     * The modules can use the method in the last step of classes rebuilding.
     * The module adds the viewer class list location via this method.
     *
     * Options array contains other info that must be added to the viewList entry.
     * \XLite\Model\ViewList entry contains `weight` and `zone` parameters
     *
     * For example:
     *
     * \XLite\Core\Layout::getInstance()->addClassToList(
     *    'modules/CDev/XMLSitemap/menu.tpl',
     *    'sidebar.second',
     *    array(
     *        'zone'   => \XLite\Model\ViewList::INTERFACE_CUSTOMER,
     *        'weight' => 100,
     *    )
     * );
     *
     * If any module decorates \XLite\Model\ViewList class and adds any other info
     * you can insert additional information via $options parameter
     *
     * @param string $tpl      Template relative path
     * @param string $listName Name of the list where the template must be located
     * @param array  $options  Additional info to add to the viewList entry
     *
     * @return \XLite\Model\ViewList
     *
     * @see \XLite\Model\ViewList
     * @see \XLite\Module\AModule::runBuildCacheHandler()
     */
    public function addTemplateToList($tpl, $listName, $options = array())
    {
        return $this->addToList(array_merge(array(
            'tpl' => $this->prepareTemplateToList($tpl),
            'list' => $listName,
        ), $options));
    }

    /**
     * Method is used as a wrapper to remove viewlist entry directly from DB
     * The remove<Template|Class>FromList() methods use the method
     *
     * @param array $data viewlist entry data to remove
     *
     * @see \XLite\Core\Layout::removeTemplateFromList()
     * @see \XLite\Core\Layout::removeClassFromList()
     */
    protected function removeFromList($data)
    {
        $repo = \XLite\Core\Database::getRepo('\XLite\Model\ViewList');
        $repo->deleteInBatch($repo->findBy($data), false);
    }

    /**
     * Method is used as a wrapper to insert viewList entry directly into DB
     * The add<Template|Class>ToList() methods use the method
     *
     * @param array $data viewList entry data to insert
     *
     * @return \XLite\Model\AEntity
     */
    protected function addToList($data)
    {
        return \XLite\Core\Database::getRepo('\XLite\Model\ViewList')->insert(new \XLite\Model\ViewList($data));
    }

    /**
     * The viewlist templates are stored in DB with the system based directory
     * separator. When using addTemplateToList() and removeTemplateFromList() methods
     * the template string must be changed to the directory separator based file path
     *
     * @param string $list
     *
     * @return string
     *
     * @see \XLite\Core\Layout::addTemplateToList()
     * @see \XLite\Core\Layout::removeTemplateFromList()
     */
    protected function prepareTemplateToList($list)
    {
        return $list;
    }

    // }}}

    // {{{ Common getters

    /**
     * Defines the LESS files to be part of the main LESS queue
     *
     * @param string $interface Interface to use: admin or customer values
     *
     * @return array
     */
    public function getLESSResources($interface)
    {
        return array(
            'css/style.less',
        );
    }

    /**
     * Return skin name
     *
     * @return string
     */
    public function getSkin()
    {
        return $this->skin;
    }

    /**
     * Return current interface
     *
     * @return string
     */
    public function getInterface()
    {
        return $this->currentInterface;
    }

    /**
     * Returns the layout path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Return list of all skins
     *
     * @return array
     */
    public function getSkinsAll()
    {
        return array(
            \XLite::CUSTOMER_INTERFACE => self::PATH_CUSTOMER,
            \XLite::COMMON_INTERFACE   => self::PATH_COMMON,
            \XLite::ADMIN_INTERFACE    => self::PATH_ADMIN,
            \XLite::CONSOLE_INTERFACE  => self::PATH_CONSOLE,
            \XLite::MAIL_INTERFACE     => self::PATH_MAIL,
        );
    }

    /**
     * getSkinPathRelative
     *
     * @param string $skin Interface
     *
     * @return void
     */
    public function getSkinPathRelative($skin)
    {
        return $skin . LC_DS . $this->locale;
    }

    // }}}

    // {{{ Substitutional skins routines

    /**
     * Add skin
     *
     * @param string $name      Skin name
     * @param string $interface Interface code OPTIONAL
     *
     * @return void
     */
    public function addSkin($name, $interface = \XLite::CUSTOMER_INTERFACE)
    {
        if (!isset($this->skins[$interface])) {
            $this->skins[$interface] = array();
        }
        array_unshift($this->skins[$interface], $name);
    }

    /**
     * Remove skin
     *
     * @param string $name      Skin name
     * @param string $interface Interface code OPTIONAL
     *
     * @return void
     */
    public function removeSkin($name, $interface = null)
    {
        if (isset($interface)) {
            if (isset($this->skins[$interface])) {
                $key = array_search($name, $this->skins[$interface]);
                if (false !== $key) {
                    unset($this->skins[$interface][$key]);
                }
            }
        } else {
            foreach ($this->skins as $interface => $list) {
                $key = array_search($name, $list);
                if (false !== $key) {
                    unset($this->skins[$interface][$key]);
                }
            }
        }
    }

    /**
     * Get skins list
     *
     * @param string $interface Interface code OPTIONAL
     *
     * @return array
     */
    public function getSkins($interface = null)
    {
        $interface = $interface ?: $this->currentInterface;
        $list = isset($this->skins[$interface]) ? $this->skins[$interface] : array();
        $list[] = $this->getBaseSkinByInterface($interface);

        return $list;
    }

    /**
     * Get template full path
     *
     * @param string $shortPath Template short path
     *
     * @return string
     */
    public function getTemplateFullPath($shortPath, $viewer)
    {
        $parts = explode(':', $shortPath, 2);
        $templateInfo = $this->getCurrentTemplateInfo();

        list($currentSkin, $currentLocale, $currentTemplate) = count($templateInfo) < 3
            ? array(null, null, $shortPath)
            : $templateInfo;

        if (1 == count($parts)) {
            $result = ('parent' == $shortPath)
                ? $this->getResourceParentFullPath($currentTemplate, $viewer->currentSkin?:$currentSkin, $viewer->currentLocale?:$currentLocale)
                : $this->getResourceFullPath($shortPath);
        } elseif ('parent' == $parts[0]) {
            $result = $this->getResourceParentFullPath($parts[1], $viewer->currentSkin?:$currentSkin, $viewer->currentLocale?:$currentLocale);
        } else {
            $result = $this->getResourceSkinFullPath($parts[1], $parts[0]);
        }

        return array($currentSkin, $currentLocale, $result);
    }

    /**
     * Defines the resource cache unique identificator of the given resource
     *
     * @param string $shortPath Short path for resource
     * @param string $interface Interface of the resource
     *
     * @return string Unique key identificator for the resource to be stored in the resource cache
     */
    protected function prepareResourceKey($shortPath, $interface)
    {
        return $this->currentInterface . '.' . $interface . '.' . $shortPath;
    }

    /**
     * Returns the resource full path
     *
     * @param string  $shortPath Short path
     * @param string  $interface Interface code OPTIONAL
     * @param boolean $doMail    Flag to change mail interface OPTIONAL
     *
     * @return string
     */
    public function getResourceFullPath($shortPath, $interface = null, $doMail = true)
    {
        $interface = $interface ?: $this->currentInterface;
        if ($doMail && \XLite::MAIL_INTERFACE === $this->currentInterface) {
            $this->currentInterface = $this->mailInterface;
        }

        $key = $this->prepareResourceKey($shortPath, $interface);
        if (!isset($this->resourcesCache[$key])) {
            foreach ($this->getSkinPaths($interface) as $path) {
                $fullPath = $path['fs'] . LC_DS . $shortPath;
                if (file_exists($fullPath)) {
                    $this->resourcesCache[$key] = $path;
                    break;
                }
            }
        }

        return isset($this->resourcesCache[$key])
            ? $this->resourcesCache[$key]['fs'] . LC_DS . $shortPath
            : null;
    }

    /**
     * Returns the resource full path before parent skin
     *
     * @param string $shortPath     Short path
     * @param string $currentSkin   Current skin
     * @param string $currentLocale Current locale
     *
     * @return string
     */
    public function getResourceParentFullPath($shortPath, $currentSkin, $currentLocale)
    {
        $found = false;
        $paths = $this->getSkinPaths($this->currentInterface);
        reset($paths);

        while(!$found && list($key, $path) = each($paths)) {
            $found = $path['name'] == $currentSkin
                && $path['locale'] == $currentLocale
                && file_exists($fullPath = $path['fs'] . LC_DS . $shortPath);
        }

        if ($found) {
            $found = false;
            while(!$found && list($key, $path) = each($paths)) {
                $found = file_exists($fullPath = $path['fs'] . LC_DS . $shortPath);
            }
        } else {
            $path = end($paths);
            $fullPath = $path['fs'] . LC_DS . $shortPath;
        }

        return $fullPath;
    }

    /**
     * Returns the resource full path by skin
     *
     * @param string $shortPath Short path
     * @param string $skin      Skin name
     *
     * @return string
     */
    public function getResourceSkinFullPath($shortPath, $skin)
    {
        $result = null;

        foreach ($this->getSkinPaths($this->currentInterface) as $path) {
            if ($path['name'] == $skin) {
                $fullPath = $path['fs'] . LC_DS . $shortPath;
                if (file_exists($fullPath)) {
                    $result = $fullPath;
                }
                break;
            }
        }

        return $result;
    }

    /**
     * Returns the resource web path
     *
     * @param string $shortPath  Short path
     * @param string $outputType Output type OPTIONAL
     * @param string $interface  Interface code OPTIONAL
     *
     * @return string
     */
    public function getResourceWebPath($shortPath, $outputType = self::WEB_PATH_OUTPUT_SHORT, $interface = null)
    {
        $interface = $interface ?: $this->currentInterface;
        $key = $interface . '.' . $shortPath;

        if (!isset($this->resourcesCache[$key])) {
            foreach ($this->getSkinPaths($interface) as $path) {
                $fullPath = $path['fs'] . LC_DS . $shortPath;
                if (file_exists($fullPath)) {
                    $this->resourcesCache[$key] = $path;
                    break;
                }
            }
        }

        return isset($this->resourcesCache[$key])
            ? $this->prepareResourceURL($this->resourcesCache[$key]['web'] . '/' . $shortPath, $outputType)
            : null;
    }

    /**
     * Prepare skin URL
     *
     * @param string $shortPath  Short path
     * @param string $outputType Output type OPTIONAL
     *
     * @return string
     */
    public function prepareSkinURL($shortPath, $outputType = self::WEB_PATH_OUTPUT_SHORT)
    {
        $skins = $this->getSkinPaths($this->currentInterface);
        $path = array_pop($skins);

        return $this->prepareResourceURL($path['web'] . '/' . $shortPath, $outputType);

    }

    /**
     * Save substitutonal skins data into cache
     *
     * @return void
     */
    public function saveSkins()
    {
        \XLite\Core\Database::getCacheDriver()->save(
            get_called_class() . '.SubstitutonalSkins',
            $this->resourcesCache
        );
    }

    /**
     * Get skin paths (file system and web)
     *
     * @param string  $interface Interface code OPTIONAL
     * @param boolean $reset     Local cache reset flag OPTIONAL
     *
     * @return array
     */
    public function getSkinPaths($interface = null, $reset = false)
    {
        $interface = $interface ?: $this->currentInterface;

        if (!isset($this->skinPaths[$interface]) || $reset) {
            $this->skinPaths[$interface] = array();

            $locales = $this->getLocalesQuery($interface);

            foreach ($this->getSkins($interface) as $skin) {
                foreach ($locales as $locale) {
                    $this->skinPaths[$interface][] = array(
                        'name' => $skin,
                        'fs'   => LC_DIR_SKINS . $skin . ($locale ? LC_DS . $locale : ''),
                        'web'  => static::PATH_SKIN . '/' . $skin . ($locale ? '/' . $locale : ''),
                        'locale' => $locale,
                    );
                }
            }
        }

        return $this->skinPaths[$interface];
    }

    /**
     * Get current template info
     *
     * @return array
     */
    protected function getCurrentTemplateInfo()
    {
        $tail = \XLite\View\AView::getTail();
        $last = array_pop($tail);

        return explode(LC_DS, substr($last, strlen(LC_DIR_SKINS)), 3);
    }

    /**
     * Get locales query
     *
     * @param string $interface Interface code
     *
     * @return array
     */
    protected function getLocalesQuery($interface)
    {
        if (\XLite::COMMON_INTERFACE == $interface) {
            $result = array(false);

        } else {

            $result = array(
                \XLite\Core\Session::getInstance()->getLanguage()->getCode(),
                $this->locale,
            );

            $result = array_unique($result);
        }

        return $result;
    }

    /**
     * Get base skin by interface code
     *
     * @param string $interface Interface code OPTIONAL
     *
     * @return string
     */
    protected function getBaseSkinByInterface($interface = null)
    {
        switch ($interface) {
            case \XLite::ADMIN_INTERFACE:
                $skin = static::PATH_ADMIN;
                break;

            case \XLite::CONSOLE_INTERFACE:
                $skin = static::PATH_CONSOLE;
                break;

            case \XLite::MAIL_INTERFACE:
                $skin = static::PATH_MAIL;
                break;

            case \XLite::COMMON_INTERFACE:
                $skin = static::PATH_COMMON;
                break;

            default:
                $options = \XLite::getInstance()->getOptions('skin_details');
                $skin = $options['skin'];
        }

        return $skin;
    }

    /**
     * Prepare resource URL
     *
     * @param string $url        URL
     * @param string $outputType Output type
     *
     * @return string
     */
    protected function prepareResourceURL($url, $outputType)
    {
        $url = trim($url);

        switch ($outputType) {
            case static::WEB_PATH_OUTPUT_FULL:
                if (preg_match('/^\w+\//Ss', $url)) {
                    $url = \XLite::getInstance()->getShopURL($url);
                }
                break;

            default:
        }


        return $url;
    }

    /**
     * Restore substitutonal skins data from cache
     *
     * @return void
     */
    protected function restoreSkins()
    {
        $data = \XLite\Core\Database::getCacheDriver()->fetch(
            get_called_class() . '.SubstitutonalSkins'
        );

        if ($data && is_array($data)) {

            $this->resourcesCache = $data;
        }
    }

    // }}}

    // {{{ Initialization routines

    /**
     * Set current skin as the admin one
     *
     * @return void
     */
    public function setAdminSkin()
    {
        $this->currentInterface = \XLite::ADMIN_INTERFACE;
        $this->setSkin(static::PATH_ADMIN);
    }

    /**
     * Set current skin as the admin one
     *
     * @return void
     */
    public function setConsoleSkin()
    {
        $this->currentInterface = \XLite::CONSOLE_INTERFACE;
        $this->setSkin(static::PATH_CONSOLE);
    }

    /**
     * Set current skin as the mail one
     *
     * @param string $interface Interface to use after MAIL one OPTIONAL
     *
     * @return void
     */
    public function setMailSkin($interface = \XLite::CUSTOMER_INTERFACE)
    {
        $this->currentInterface = \XLite::MAIL_INTERFACE;

        $this->mailInterface = $interface;

        $this->setSkin(static::PATH_MAIL);
    }

    /**
     * Set current skin as the customer one
     *
     * @return void
     */
    public function setCustomerSkin()
    {
        $this->skin = null;
        $this->locale = null;
        $this->currentInterface = \XLite::CUSTOMER_INTERFACE;

        $this->setOptions();
    }


    /**
     * Set current skin
     *
     * @param string $skin New skin
     *
     * @return void
     */
    public function setSkin($skin)
    {
        $this->skin = $skin;
        $this->setPath();
    }

    /**
     * Set some class properties
     *
     * @return void
     */
    protected function setOptions()
    {
        $options = \XLite::getInstance()->getOptions('skin_details');

        foreach (array('skin', 'locale') as $name) {
            if (!isset($this->$name)) {
                $this->$name = $options[$name];
            }
        }

        $this->setPath();
    }

    /**
     * Set current skin path
     *
     * @return void
     */
    protected function setPath()
    {
        $this->path = self::PATH_SKIN
            . LC_DS . $this->skin
            . ($this->locale ? LC_DS . $this->locale : '')
            . LC_DS;
    }

    /**
     * Constructor
     *
     * @return void
     */
    protected function __construct()
    {
        parent::__construct();

        $this->setOptions();

        $this->skinsCache = (bool)\XLite::getInstance()
            ->getOptions(array('performance', 'skins_cache'));

        if ($this->skinsCache) {
            $this->restoreSkins();
            register_shutdown_function(array($this, 'saveSkins'));
        }
    }

    // }}}

    // {{{ Resources

    /**
     * Register resources
     *
     * @param array   $resources Resources
     * @param integer $index     Index (weight)
     * @param string  $interface Interface
     *
     * @return void
     */
    public function registerResources(array $resources, $index, $interface = null)
    {
        foreach ($resources as $type => $files) {
            $method = 'register' . strtoupper($type) . 'Resources';

            if (method_exists($this, $method)) {
                $this->{$method}($files, $index, $interface);
            }
        }

        $this->prepareResourcesFlag = false;
    }

    /**
     * Return list of all registered resources
     *
     * @return array
     */
    public function getRegisteredResources()
    {
        $result = array();
        foreach ($this->getResourcesTypes() as $type) {
            $result[$type] = $this->getRegisteredResourcesByType($type);
        }

        return $result;
    }

    /**
     * Get registered resources by type
     *
     * @param string $type Resource type
     *
     * @return array
     */
    public function getRegisteredResourcesByType($type)
    {
        $result = array();
        foreach ($this->getPreparedResources() as $subresources) {
            if (!empty($subresources[$type])) {
                foreach ($subresources[$type] as $path => $file) {
                    $result[$path] = $file;
                }
            }
        }

        return $result;
    }

    /**
     * Return list of all registered and prepared resources
     *
     * @return array
     */
    public function getRegisteredPreparedResources()
    {
        $result = array();
        foreach ($this->getResourcesTypes() as $type) {
            $result[$type] = $this->getPreparedResourcesByType($type);
        }

        return $result;
    }

    /**
     * Get registered and prepared resources by type
     *
     * @param string $type Resource type
     *
     * @return array
     */
    public function getPreparedResourcesByType($type)
    {
        $resources = array_filter(
            \XLite\Core\Layout::getInstance()->getRegisteredResourcesByType($type),
            array($this, 'isValid' . strtoupper($type) . 'Resource')
        );

        $method = 'prepare' . strtoupper($type) . 'Resources';

        return $this->$method($resources);
    }

    /**
     * Get resources types
     *
     * @return array
     */
    public function getResourcesTypes()
    {
        return array(
            \XLite\View\AView::RESOURCE_JS,
            \XLite\View\AView::RESOURCE_CSS,
        );
    }

    /**
     * Get prepared resources
     *
     * @return array
     */
    protected function getPreparedResources()
    {
        if (!$this->prepareResourcesFlag) {
            $this->resources = $this->prepareResources($this->resources);
            $this->prepareResourcesFlag = true;
        }

        return $this->resources;
    }

    /**
     * Prepare resources
     *
     * @param array $resources Resources
     *
     * @return array
     */
    protected function prepareResources(array $resources)
    {
        ksort($resources, SORT_NUMERIC);

        foreach ($resources as $index => $subresources) {
            foreach ($subresources as $type => $files) {
                foreach ($files as $name => $file) {
                    $file = $this->prepareResource($file, $type);
                    if ($file) {
                        $files[$name] = $file;

                    } else {
                        unset($files[$name]);
                    }
                }

                if ($files) {
                    $subresources[$type] = $files;

                } else {
                    unset($subresources[$type]);
                }
            }

            if ($subresources) {
                $resources[$index] = $subresources;

            } else {
                unset($resources[$index]);
            }
        }

        return $resources;
    }

    /**
     * Prepare resource
     *
     * @param array  $data Resource data
     * @param string $type Resource type
     *
     * @return array
     */
    protected function prepareResource(array $data, $type)
    {
        $data = $this->prepareResourceFullURL($data, $type);
        if ($data) {
            $method = 'prepareResource' . strtoupper($type);
            if (method_exists($this, $method)) {
                $data = $this->$method($data, $type);
            }
        }

        return $data;
    }

    /**
     * Prepare resource full URL
     *
     * @param array  $data Resource data
     * @param string $type Resource type
     *
     * @return array
     */
    protected function prepareResourceFullURL(array $data, $type)
    {
        if (empty($data['url'])) {
            foreach ($data['filelist'] as $file) {

                $shortURL = str_replace(LC_DS, '/', $file);

                $fullURL = $this->getResourceWebPath(
                    $shortURL,
                    \XLite\Core\Layout::WEB_PATH_OUTPUT_URL,
                    $data['interface']
                );

                if (isset($fullURL)) {
                    $data['original'] = $data['file'];
                    $data['file'] = $this->getResourceFullPath($shortURL, $data['interface'], false);
                    $data += array(
                        'media' => 'all',
                        'url'   => $fullURL,
                    );

                    break;
                }
            }
        }

        return empty($data['url']) ? null : $data;
    }

    /**
     * Prepare resource as CSS
     *
     * @param array  $data Resource data
     * @param string $type Resource type
     *
     * @return array
     */
    protected function prepareResourceCSS(array $data, $type)
    {
        if ($this->isLESSResource($data)) {
            $data = $this->prepareResourceLESS($data);
        }

        return $data;
    }

    /**
     * Check if the resource is a LESS one
     *
     * @param array $data Resource data
     *
     * @return boolean
     */
    protected function isLESSResource(array $data)
    {
        return preg_match('/\.less$/Ss', $data['file']);
    }

    /**
     * Prepare resource as LESS
     *
     * @param array $data Resource data
     *
     * @return array
     */
    protected function prepareResourceLESS($data)
    {
        $data['less'] = true;

        return $data;
    }

    /**
     * Prepare resource as JS
     *
     * @param array  $data Resource data
     * @param string $type Resource type
     *
     * @return array
     */
    protected function prepareResourceJS(array $data, $type)
    {
        return $data;
    }

    /**
     * Prepare CSS resources
     *
     * @param array $resources Resources
     *
     * @return array
     */
    protected function isValidCSSResource(array $resource)
    {
        return isset($resource['url']);
    }

    /**
     * Prepare JS resources
     *
     * @param array $resources Resources
     *
     * @return array
     */
    protected function isValidJSResource(array $resource)
    {
        return isset($resource['url']);
    }

    /**
     * Prepare CSS resources
     *
     * @param array $resources Resources
     *
     * @return array
     */
    protected function prepareCSSResources(array $resources)
    {
        $lessResources = array();

        // Detect the merged resources grouping
        foreach ($resources as $index => $resource) {
            if (isset($resource['less'])) {
                if (isset($resource['merge'])) {
                    $lessResources[$resource['merge']][] = $resource;
                    unset($resources[$index]);
                }
            }
        }

        foreach ($resources as $index => $resource) {
            if (isset($resource['less'])) {
                if (!isset($lessResources[$resource['original']])) {
                    // one resource group is registered
                    $lessGroup = array($resource);

                } else {
                    // The resource is placed into the head of the less resources list
                    $lessGroup = array_merge(array($resource), $lessResources[$resource['original']]);
                }

                $resources[$index] = \XLite\Core\LessParser::getInstance()->makeCSS($lessGroup);

                // Media type is derived from the parent resource
                $resources[$index]['media'] = $resource['media'];
            }
        }

        return $resources;
    }

    /**
     * Prepare JS resources
     *
     * @param array $resources Resources
     *
     * @return array
     */
    protected function prepareJSResources(array $resources)
    {
        return $resources;
    }

    /**
     * Main JS resources registrator. see self::registerResources() for more info
     *
     * @param array   $files     List of file relative pathes to the resources
     * @param integer $index     Position in the ordered resources queue
     * @param string  $interface Interface where the files are located
     *
     * @see \XLite\View\AView::registerResources()
     */
    protected function registerJSResources(array $files, $index, $interface)
    {
        $this->registerResourcesByType($files, $index, $interface, \XLite\View\AView::RESOURCE_JS);
    }

    /**
     * Main CSS resources registrator. see self::registerResources() for more info
     *
     * @param array   $files     List of file relative pathes to the resources
     * @param integer $index     Position in the ordered resources queue
     * @param string  $interface Interface where the files are located
     *
     * @see \XLite\View\AView::registerResources()
     */
    protected function registerCSSResources(array $files, $index, $interface)
    {
        $this->registerResourcesByType($files, $index, $interface, \XLite\View\AView::RESOURCE_CSS);
    }

    /**
     * Main common registrator of resources. see self::registerResources() for more info
     * This method takes the files list and registers them as the resources of the provided $type
     *
     * @param array   $files     List of file relative pathes to the resources
     * @param integer $index     Position in the ordered resources queue
     * @param string  $interface Interface where the files are located
     * @param string  $type      Type of the resources ('js', 'css')
     *
     */
    protected function registerResourcesByType(array $files, $index, $interface, $type)
    {
        foreach ($files as $resource) {
            $resource = $this->prepareResourceByType($resource, $index, $interface, $type);
            $hash = md5(serialize($resource));
            if ($resource && !isset($this->resources[$index][$type][$hash])) {
                $this->resources[$index][$type][$hash] = $resource;
            }
        }
    }

    /**
     * The resource must be prepared before the registration in the resources storage:
     * - the file must be correctly located and full file path must be found
     * - the web location of the resource must be found
     *
     * Then this method actually stores the resource into the static resources storage
     *
     * @param string|array $resource  Resource file path or array of resources
     * @param integer      $index
     * @param string       $interface
     * @param string       $type
     *
     * @return array
     */
    protected function prepareResourceByType($resource, $index, $interface, $type)
    {
        if (empty($resource)) {
            $resource = null;

        } elseif (is_string($resource)) {
            $resource = array(
                'file'     => $resource,
                'filelist' => array($resource),
            );
        }

        if ($resource && !isset($resource['url'])) {
            if (!isset($resource['filelist'])) {
                $resource['filelist'] = array($resource['file']);
            }

            if (!isset($resource['interface'])) {
                $resource['interface'] = $interface;
            }
        }

        return $resource;
    }

    // }}}
}
