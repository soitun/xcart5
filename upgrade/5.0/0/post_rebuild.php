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
    $yamlFile = LC_DIR_VAR . 'temporary.classes.yaml';

    if (file_exists($yamlFile)) {
        $data = \Includes\Utils\Operator::loadServiceYAML($yamlFile);
        if ($data) {
            if ($data['taxClasses']) {
                foreach ($data['taxClasses'] as $id => $name) {
                    $taxClass = new \XLite\Model\TaxClass;
                    $taxClass->setName($name);
                    \XLite\Core\Database::getRepo('XLite\Model\TaxClass')->insert($taxClass);
                    $data['taxClasses'][$id] = $taxClass;
                }
                \XLite\Core\Database::getEM()->flush();
        
                if ($data['taxRates']) {
                    foreach ($data['taxRates'] as $tax => $rates) {
                        if (class_exists('\XLite\Module\CDev\\' . $tax . '\Main')) {
                            $repo = \XLite\Core\Database::getRepo('XLite\Module\CDev\\' . $tax . '\Model\Tax\Rate');
                            foreach ($rates as $rateId => $taxClassId) {
                                $repo->find($rateId)->setTaxClass($data['taxClasses'][$taxClassId]);
                            }
                        }
                    }
                    \XLite\Core\Database::getEM()->flush();
                }
                
                if ($data['productTaxClass']) {
                    $repo = \XLite\Core\Database::getRepo('XLite\Model\Product');
                    foreach ($data['productTaxClass'] as $productId => $taxClassId) {
                        $repo->find($productId)->setTaxClass($data['taxClasses'][$taxClassId]);
                    }
                    \XLite\Core\Database::getEM()->flush();
                }
                
                if ($data['shippingMethods']) {
                    $repo = \XLite\Core\Database::getRepo('XLite\Model\Shipping\Method');
                    foreach ($data['shippingMethods'] as $shippingMethodId => $taxClassId) {
                        $repo->find($shippingMethodId)->setTaxClass($data['taxClasses'][$taxClassId]);
                    }
                    \XLite\Core\Database::getEM()->flush();
                }
            }

            if ($data['productClass']) {
                foreach ($data['productClass'] as $productId => $productClassId) { 
                    \XLite\Core\Database::getRepo('XLite\Model\Product')->find($productId)->setProductClass(
                        \XLite\Core\Database::getRepo('XLite\Model\ProductClass')->find($productClassId)
                    ); 
                }
                \XLite\Core\Database::getEM()->flush();
            }
        }
    }

    \Includes\Utils\FileManager::deleteFile($yamlFile);

    // 'Use widget cache' option is on by default
    $repo = \XLite\Core\Database::getRepo('XLite\Model\Config');

    $option = $repo->findOneBy(array('name' => 'use_view_cache'));
    if ($option) {
        $option->setValue('Y');
    }

    // Insert attribute modifier
    $repo = \XLite\Core\Database::getRepo('XLite\Model\MoneyModificator');

    $isModifierExists = $repo->findOneBy(array('class' => 'XLite\\Logic\\AttributeSurcharge'));

    if (!$isModifierExists) {

        $data = array(
            'class'     => 'XLite\\Logic\\AttributeSurcharge',
            'validator' => 'isApply',
            'purpose'   => 'net',
            'position'  => 10,
        );

        $modifier = new \XLite\Model\MoneyModificator();
        $modifier->map($data);

        \XLite\Core\Database::getEM()->persist($modifier);
    }

    \XLite\Core\Database::getEM()->flush();
    \XLite\Core\Database::getCacheDriver()->deleteAll();
};
