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

namespace XLite\View\Model;

/**
 * Category view model
 */
class Category extends \XLite\View\Model\AModel
{
    /**
     * Schema default
     *
     * @var array
     */
    protected $schemaDefault = array(
        'name' => array(
            self::SCHEMA_CLASS    => 'XLite\View\FormField\Input\Text',
            self::SCHEMA_LABEL    => 'Category name',
            self::SCHEMA_REQUIRED => true,
        ),
        'show_title' => array(
            self::SCHEMA_CLASS    => 'XLite\View\FormField\Select\CategoryShowTitle',
            self::SCHEMA_LABEL    => 'Show Category title',
            self::SCHEMA_REQUIRED => false,
        ),
        'image' => array(
            self::SCHEMA_CLASS    => 'XLite\View\FormField\FileUploader\Image',
            self::SCHEMA_LABEL    => 'Category icon',
            self::SCHEMA_REQUIRED => false,
        ),
        'description' => array(
            self::SCHEMA_CLASS    => 'XLite\View\FormField\Textarea\Advanced',
            self::SCHEMA_LABEL    => 'Description',
            self::SCHEMA_REQUIRED => false,
        ),
        'cleanURL' => array(
            self::SCHEMA_CLASS    => 'XLite\View\FormField\Input\Text\CleanURL',
            self::SCHEMA_LABEL    => 'Clean URL',
            self::SCHEMA_REQUIRED => false,
            \XLite\View\FormField\Input\Text\CleanURL::PARAM_OBJECT_CLASS_NAME => '\XLite\Model\Category'
        ),
        'meta_title' => array(
            self::SCHEMA_CLASS    => 'XLite\View\FormField\Input\Text',
            self::SCHEMA_LABEL    => 'Custom HTML title',
            self::SCHEMA_HELP     => 'Leave the field empty to autogenerate a value for the HTML title tag',
            self::SCHEMA_REQUIRED => false,
        ),
        'meta_tags' => array(
            self::SCHEMA_CLASS    => 'XLite\View\FormField\Input\Text',
            self::SCHEMA_LABEL    => 'Meta tags',
            self::SCHEMA_REQUIRED => false,
        ),
        'meta_desc' => array(
            self::SCHEMA_CLASS    => 'XLite\View\FormField\Textarea\Simple',
            self::SCHEMA_LABEL    => 'Meta desc',
            self::SCHEMA_REQUIRED => false,
        ),
        'memberships' => array(
            self::SCHEMA_CLASS    => 'XLite\View\FormField\Select\Memberships',
            self::SCHEMA_LABEL    => 'Memberships',
            self::SCHEMA_REQUIRED => false,
        ),
        'enabled' => array(
            self::SCHEMA_CLASS    => 'XLite\View\FormField\Select\YesNo',
            self::SCHEMA_LABEL    => 'Enabled',
            self::SCHEMA_REQUIRED => false,
        ),
    );

    /**
     * Return current model ID
     *
     * @return integer
     */
    public function getModelId()
    {
        return \XLite\Core\Request::getInstance()->id;
    }

    /**
     * This object will be used if another one is not pased
     *
     * @return \XLite\Model\Category
     */
    protected function getDefaultModelObject()
    {
        $model = $this->getModelId()
            ? \XLite\Core\Database::getRepo('XLite\Model\Category')->find($this->getModelId())
            : null;

        return $model ?: new \XLite\Model\Category;
    }

    /**
     * Populate model object properties by the passed data
     *
     * @param array $data Data to set
     *
     * @return void
     */
    protected function setModelProperties(array $data)
    {
        $memberships = $data['memberships'];
        unset($data['memberships']);

        if (isset($data['enabled']) && is_string($data['enabled'])) {
            $data['enabled'] = 'Y' == $data['enabled'];
        }

        if ($this->getPostedData('autogenerateCleanURL')) {
            $data['cleanURL'] = \XLite\Core\Database::getRepo('XLite\Model\Category')->generateCleanURL(
                $this->getDefaultModelObject(),
                $data['name']
            );
        }

        parent::setModelProperties($data);

        $model = $this->getModelObject();

        // Remove old links
        foreach ($model->getMemberships() as $membership) {
            $membership->getCategories()->removeElement($model);
        }
        $model->getMemberships()->clear();

        if (isset($memberships) && $memberships) {
            // Add new links
            foreach ($memberships as $mid) {
                $membership = \XLite\Core\Database::getRepo('XLite\Model\Membership')->find($mid);
                if ($membership) {
                    $model->addMemberships($membership);
                    $membership->addCategory($model);
                }
            }
        }

        if (!$model->isPersistent()) {
            $parent = null;
            if (\XLite\Core\Request::getInstance()->parent) {
                $parent = \XLite\Core\Database::getRepo('XLite\Model\Category')->find(intval(\XLite\Core\Request::getInstance()->parent));
            }

            if (!$parent) {
                $parent = \XLite\Core\Database::getRepo('XLite\Model\Category')->getRootCategory();
            }

            $model->setParent($parent);

            // Resort
            $pos = 0;
            $model->setPos($pos);
            foreach ($parent->getChildren() as $child) {
                $pos += 10;
                $child->setPos($pos);
            }
        }
    }

    /**
     * Return name of web form widget class
     *
     * @return string
     */
    protected function getFormClass()
    {
        return '\XLite\View\Form\Model\Category';
    }

    /**
     * Return list of the "Button" widgets
     *
     * @return array
     */
    protected function getFormButtons()
    {
        $result = parent::getFormButtons();

        $label = $this->getModelObject()->isPersistent() ? 'Update' : 'Create';

        $result['submit'] = new \XLite\View\Button\Submit(
            array(
                \XLite\View\Button\AButton::PARAM_LABEL => $label,
                \XLite\View\Button\AButton::PARAM_STYLE => 'action',
            )
        );

        return $result;
    }

    /**
     * Add top message
     *
     * @return void
     */
    protected function addDataSavedTopMessage()
    {
        if ('create' != $this->currentAction) {
            \XLite\Core\TopMessage::addInfo('The category has been updated');

        } else {
            \XLite\Core\TopMessage::addInfo('The category has been added');
        }
    }

}
