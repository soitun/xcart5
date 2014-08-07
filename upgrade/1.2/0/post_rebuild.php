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
    // Change category for some options
    $repo = \XLite\Core\Database::getRepo('XLite\Model\Config');

    $settings = array(
        'Units' => array('weight_unit', 'weight_symbol', 'thousand_delim', 'decimal_delim', 'date_format', 'time_format', 'time_zone'),
        'General' => array('terms_url'),
        '' => array('shop_closed'),
    );

    foreach ($settings as $category => $names) {

        foreach ($names as $name) {

            // Get all options with specified name
            $options = $repo->findBy(array('name' => $name));

            $found = false;

            // Find if option is already exists
            foreach ($options as $option) {
                if ($option->getCategory() == $category) {
                    $found = true;
                }
            }

            foreach ($options as $option) {
        
                if ($option->getCategory() != $category) {

                   if ($found) { 
                       \XLite\Core\Database::getEM()->remove($option);

                   } else {
                       $option->setCategory($category);
                   }
                }
            }
        }
    }

    // Remove obsolete options
    $removedOptions = array(
        'unit_presentation',
        'operation_presentation',
        'check_templates_status',
        'form_id_protection',
        'last_date',
        'proxy',
    );

    foreach ($removedOptions as $name) {
        $option = $repo->findOneBy(array('name' => $name));
        if ($option) {
            \XLite\Core\Database::getEM()->remove($option);
        }
    }

    $option = $repo->findOneBy(array('name' => 'company_address'));
    if ($option) {
        $option->setOptionName('Company address');
    }

    \XLite\Core\Database::getEM()->flush();
    \XLite\Core\Database::getCacheDriver()->deleteAll();
};
