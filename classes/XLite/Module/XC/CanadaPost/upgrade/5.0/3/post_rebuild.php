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

return function()
{
    // Loading data to the database from yaml file
    $yamlFile = __DIR__ . LC_DS . 'post_rebuild.yaml';

    if (\Includes\Utils\FileManager::isFileReadable($yamlFile)) {
        \XLite\Core\Database::getInstance()->loadFixturesFromYaml($yamlFile);
    }

    // Reset translations
    \XLite\Core\Translation::getInstance()->reset();

    // Reset config
    \XLite\Core\Config::updateInstance();

    // Remove old options
    $optionsToRemove = \XLite\Core\Database::getRepo('XLite\Model\Config')->findBy(
        array(
            'name'     => array('use_insurance', 'insurance'),
            'category' => 'XC\CanadaPost',
        )
    );

    foreach ($optionsToRemove as $option) {
        \XLite\Core\Database::getEM()->remove($option);
    }

    // Disable merchant registration wizard if account is active
    if (
        !empty(\XLite\Core\Config::getInstance()->XC->CanadaPost->user)
        && !empty(\XLite\Core\Config::getInstance()->XC->CanadaPost->password)
    ) {
        $wizardEnabledOpt = \XLite\Core\Database::getRepo('XLite\Model\Config')
            ->findOneBy(array('name' => 'wizard_enabled', 'category' => 'XC\CanadaPost'));

        $wizardEnabledOpt->setValue('N');

        \XLite\Core\Database::getEM()->persist($wizardEnabledOpt);
    }

    // Update "quote_type" option's value
    $quoteTypeOpt = \XLite\Core\Database::getRepo('XLite\Model\Config')
        ->findOneBy(array('name' => 'quote_type', 'category' => 'XC\CanadaPost'));

    if (!$quoteTypeOpt) {
        $quoteTypeOpt = new \XLite\Model\Config();
        $quoteTypeOpt->setCategory('XC\CanadaPost');
        $quoteTypeOpt->setName('quote_type');
    }

    $quoteTypeValue = ('commercial' == $quoteTypeOpt->getValue())
        ? 'C'  // \XLite\Module\XC\CanadaPost\Core\API::QUOTE_TYPE_CONTRACTED
        : 'N'; // \XLite\Module\XC\CanadaPost\Core\API::QUOTE_TYPE_NON_CONTRACTED

    $quoteTypeOpt->setValue($quoteTypeValue);

    \XLite\Core\Database::getEM()->persist($quoteTypeOpt);

    // Flush changes
    \XLite\Core\Database::getEM()->flush();
};
