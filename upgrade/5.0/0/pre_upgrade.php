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
    $configUnits = \XLite\Core\Config::getInstance()->Units;
    foreach (\XLite\Core\Database::getRepo('XLite\Model\Attribute')->findByType(\XLite\Model\Attribute::TYPE_NUMBER) as $a) {
        $values = array();
        foreach (\XLite\Core\Database::getRepo('XLite\Model\AttributeValue\AttributeValueNumber')->findByAttribute($a) as $v) {
            $value = number_format($v->getValue(), $v->getAttribute()->getDecimals(), $configUnits->decimal_delim, $configUnits->thousand_delim);
            $values[$value][] = $v->getProduct()->getProductId();
        }
        $a->setType(\XLite\Model\Attribute::TYPE_SELECT);
        if ($values) {
            foreach ($values as $value => $ids) {
                $attributeOption = new \XLite\Model\AttributeOption();
                $attributeOption->setAttribute($a);
                $attributeOption->setName($value);
                \XLite\Core\Database::getEM()->persist($attributeOption);

                foreach ($ids as $id) {
                    $attributeValue = new \XLite\Model\AttributeValue\AttributeValueSelect();
                    $attributeValue->setProduct(\XLite\Core\Database::getRepo('XLite\Model\Product')->find($id));
                    $attributeValue->setAttribute($a);
                    \XLite\Core\Database::getEM()->persist($attributeValue);
                    $attributeValue->setAttributeOption($attributeOption);
                }
            }
        }
        \XLite\Core\Database::getEM()->flush();
    }

    $taxClasses = $taxRates = $productClass = $productTaxClass = $shippingMethods = array();

    foreach (array('VAT', 'SalesTax') as $tax) {
        if (class_exists('\XLite\Module\CDev\\' . $tax . '\Main')) {
            $repo = \XLite\Core\Database::getRepo('XLite\Module\CDev\\' . $tax . '\Model\Tax\Rate');

            $data = $repo->createQueryBuilder()
                ->andWhere('r.productClass is not null')
                ->getResult();

            foreach ($data as $r) {
                $taxClasses[$r->getProductClass()->getId()] = $r->getProductClass()->getName();
                $taxRates[$tax][$r->getId()] = $r->getProductClass()->getId();
                $r->setProductClass(null);
            }
            \XLite\Core\Database::getEM()->flush();
        }
    }

    $repo = \XLite\Core\Database::getRepo('XLite\Model\Product');

    $data = $repo->createQueryBuilder()
        ->linkInner('p.classes')
        ->getResult();

    foreach ($data as $p) {
        foreach ($p->getClasses() as $c) {
            if ($c->getAttributesCount()) {
                $productClass[$p->getProductId()] = $c->getId();
                break;
            }
        }
        if ($taxClasses) {
            foreach ($p->getClasses() as $c) {
                if (isset($taxClasses[$c->getId()])) {
                    $productTaxClass[$p->getProductId()] = $c->getId();
                    break;
                }
            }
        }
    }

    $repo = \XLite\Core\Database::getRepo('XLite\Model\Shipping\Method');

    $data = $repo->createQueryBuilder()
        ->linkInner('m.classes')
        ->getResult();

    foreach ($data as $m) {
        $sm = $m->getClasses()->first();
        $taxClasses[$sm->getId()] = $sm->getName();
        $shippingMethods[$m->getMethodId()] = $sm->getId();
    }

    \Includes\Utils\Operator::saveServiceYAML(
        LC_DIR_VAR . 'temporary.classes.yaml',
        array(
            'taxClasses'       => $taxClasses,
            'taxRates'         => $taxRates,
            'productClass'     => $productClass,
            'productTaxClass'  => $productTaxClass,
            'shippingMethods'  => $shippingMethods,
        )
    );
};
