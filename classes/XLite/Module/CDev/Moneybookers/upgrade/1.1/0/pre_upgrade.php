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

return function()
{
    // Update language labels
    $labels = array(
        'update' => array(
            'If you don\'t have a moneybookers account yet, please sign up for a free moneybookers account at: http://www.moneybookers.com' => array('To process your customers\' payments with Moneybookers, you need a Moneybookers account. If you do not have one yet, you can sign up for free at http://www.moneybookers.com', array('If you don\'t have a moneybookers account yet, please sign up for a free moneybookers account at: <a href="http://www.moneybookers.com/partners/?p=LiteCommerce">http://www.moneybookers.com</a>', 'To process your customers\' payments with Moneybookers, you need a Moneybookers account. If you do not have one yet, you can sign up for free at <a href="http://www.moneybookers.com/partners/?p=LiteCommerce">http://www.moneybookers.com</a>')),
        ),
    );

    $objects = array();

    foreach ($labels as $method => $tmp) {
        $objects[$method] = array();

        foreach ($tmp as $oldKey => $data) {
            $object = \XLite\Core\Database::getRepo('\XLite\Model\LanguageLabel')->findOneBy(array('name'=>$oldKey));

            if (isset($object)) {
                if (empty($data)) {
                    $data = $oldKey;
                }

                switch ($method) {
                    case 'update':
                        if (is_array($data)) {
                            list($newKey, list($oldTranslation, $newTranslation)) = $data;

                            if (isset($newKey)) {
                                $object->setName($newKey);
                            }

                            if (is_null($object->getLabel())) {
                                $objects['delete'] = $object;
                                unset($object);

                            } elseif ($object->getLabel() === $oldTranslation) {
                                if (isset($newTranslation)) {
                                    $object->setLabel($newTranslation);

                                } else {
                                    $objects['delete'] = $object;
                                    unset($object);
                                }
                            }

                        } else {
                            $object->setName($data);
                        }

                        break;

                    case 'delete':
                        if (!is_null($object->getLabel()) && $object->getLabel() !== $data) {
                            unset($object);
                        }

                        break;

                    default:
                        // ...
                }

            } elseif ('insert' === $method) {
                $object = new \XLite\Model\LanguageLabel();
                $object->setName($oldKey);
                $object->setLabel($data);
            }

            if (isset($object)) {
                $objects[$method][] = $object;
            }
        }
    }

    foreach ($objects as $method => $labels) {
        \XLite\Core\Database::getRepo('\XLite\Model\LanguageLabel')->{$method . 'InBatch'}($labels);
    }

};
