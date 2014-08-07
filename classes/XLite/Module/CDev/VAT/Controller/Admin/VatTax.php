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

namespace XLite\Module\CDev\VAT\Controller\Admin;

/**
 * Taxes controller
 */
class VatTax extends \XLite\Controller\Admin\AAdmin
{
    // {{{ Widget-specific getters

    /**
     * Get tax
     *
     * @return object
     */
    public function getTax()
    {
        return \XLite\Core\Database::getRepo('XLite\Module\CDev\VAT\Model\Tax')->getTax();
    }

    // }}}

    // {{{ Actions

    /**
     * Update tax rate
     *
     * @return void
     */
    protected function doActionUpdate()
    {
        $tax = $this->getTax();

        $name = trim(\XLite\Core\Request::getInstance()->name);
        if (0 < strlen($name)) {
            $tax->setName($name);

        } else {
            \XLite\Core\TopMessage::addError('The name of the tax has not been preserved, because that is not filled');
        }

        $optionNames = array(
            'display_prices_including_vat',
            'display_inc_vat_label',
        );

        foreach ($optionNames as $optionName) {

            $optionValue = !empty(\XLite\Core\Request::getInstance()->$optionName)
                ? \XLite\Core\Request::getInstance()->$optionName
                : 'N';

            if ('display_inc_vat_label' == $optionName) {
                $allowedOptionValues = array(
                    \XLite\Module\CDev\VAT\View\FormField\LabelModeSelector::DO_NOT_DISPLAY,
                    \XLite\Module\CDev\VAT\View\FormField\LabelModeSelector::PRODUCT_DETAILS,
                    \XLite\Module\CDev\VAT\View\FormField\LabelModeSelector::ALL_CATALOG,
                );
                $optionValue = in_array($optionValue, $allowedOptionValues) ? $optionValue : $allowedOptionValues[0];
            }

            $optionData = array(
                'name'     => $optionName,
                'category' => 'CDev\\VAT',
                'value'    => $optionValue,
            );
            \XLite\Core\Database::getRepo('XLite\Model\Config')->createOption($optionData);
        }

        // Set VAT base properties
        $vatMembership = \XLite\Core\Request::getInstance()->vatMembership;
        $vatMembership = $vatMembership
            ? \XLite\Core\Database::getRepo('XLite\Model\Membership')->find($vatMembership)
            : null;
        $tax->setVATMembership($vatMembership);

        $vatZone = \XLite\Core\Request::getInstance()->vatZone;
        $vatZone = $vatZone
            ? \XLite\Core\Database::getRepo('XLite\Model\Zone')->find($vatZone)
            : null;
        $tax->setVATZone($vatZone);

        $list = new \XLite\Module\CDev\VAT\View\ItemsList\Model\Rate;
        $list->processQuick();

        $rates = \XLite\Core\Database::getRepo('XLite\Module\CDev\VAT\Model\Tax\Rate')->findBy(array('tax' => null));
        foreach ($rates as $rate) {
            $tax->addRates($rate);
            $rate->setTax($tax);
        }

        \XLite\Core\TopMessage::addInfo('VAT settings and rates have been updated successfully');
        \XLite\Core\Database::getEM()->flush();
    }

    /**
     * Switch tax state
     *
     * @return void
     */
    protected function doActionSwitch()
    {
        $tax = $this->getTax();
        $tax->setEnabled(!$tax->getEnabled());
        \XLite\Core\Database::getEM()->flush();
        $this->setPureAction(true);

        if ($tax->getEnabled()) {
            \XLite\Core\TopMessage::addInfo('VAT has been enabled successfully');

        } else {
            \XLite\Core\TopMessage::addInfo('VAT has been disabled successfully');
        }
    }

    /**
     * Define the actions with no secure token
     *
     * @return array
     */
    public static function defineFreeFormIdActions()
    {
        return array_merge(parent::defineFreeFormIdActions(), array('switch'));
    }

    // }}}
}
