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

namespace XLite\View\FormField\Select;

/**
 * Category selector
 */
class Classes extends \XLite\View\FormField\Select\Multiple
{

    /**
     * getCSSFiles
     *
     * @return array
     */
    public function getCSSFiles()
    {
        $list = parent::getCSSFiles();

        $list[] = $this->getDir() . '/select_classes.css';

        return $list;
    }

    /**
     * getJSFiles
     *
     * @return array
     */
    public function getJSFiles()
    {
        $list = parent::getJSFiles();

        $list[] = $this->getDir() . '/select_classes.js';

        return $list;
    }

    /**
     * Return field template
     *
     * @return string
     */
    protected function getFieldTemplate()
    {
        return 'select_classes.tpl';
    }

    /**
     * Return class list
     *
     * @return array
     */
    protected function getDefaultOptions()
    {
        $list = array();
        foreach (\XLite\Core\Database::getRepo('\XLite\Model\ProductClass')->search() as $class) {
            $list[$class->getId()] = $class->getName();
        }

        return $list;
    }

    /**
     * Return String representation of selected product classes
     *
     * @return string
     */
    protected function getSelectedClassesList()
    {
        $classNames = array();

        foreach ($this->getValue()->toArray() as $class) {
            $classNames[] = $class->getName();
        }

        return implode(', ', $classNames);
    }
}
