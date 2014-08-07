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

namespace Includes\Decorator\Plugin\ModuleControllers;

/**
 * Main 
 *
 */
class Main extends \Includes\Decorator\Plugin\APlugin
{
    /**
     * Pattern to detect/modify module contoller class name
     */
    const PATTERN = '/^XLite\\\(Module\\\[\w]+\\\[\w]+\\\)Controller(\\\[\w\\\]*)$/Ss';

    /**
     * Execute certain hook handler
     *
     * @return void
     */
    public function executeHookHandler()
    {
        static::getClassesTree()->walkThrough(array($this, 'changeControllerClass'));
    }

    /**
     * Change class name for "module controllers"
     * NOTE: method is public since it's used as a callback in external class
     *
     * @param \Includes\Decorator\DataStructure\Graph\Classes $node Current node
     *
     * @return void
     */
    public function changeControllerClass(\Includes\Decorator\DataStructure\Graph\Classes $node)
    {
        if ($this->isModuleController($node)) {
            $node->setKey($this->prepareModuleControllerClass($node), true);
        }
    }

    /**
     * Method to check class nodes in tree
     *
     * @param \Includes\Decorator\DataStructure\Graph\Classes $node Node to check
     *
     * @return boolean
     */
    protected function isModuleController(\Includes\Decorator\DataStructure\Graph\Classes $node)
    {
        return !$node->isDecorator() && preg_match(static::PATTERN, $node->getClass());
    }

    /**
     * Remove the module-related part from module controller class
     *
     * @param \Includes\Decorator\DataStructure\Graph\Classes $node Node to get and prepare class
     *
     * @return void
     */
    protected function prepareModuleControllerClass(\Includes\Decorator\DataStructure\Graph\Classes $node)
    {
        return preg_replace(static::PATTERN, 'XLite\\\\Controller$2', $node->getClass());
    }
}
