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

namespace XLite\Module\CDev\USPS\Controller\Admin;

/**
 * USPS module settings page controller
 */
class Usps extends \XLite\Controller\Admin\ShippingSettings
{
    /**
     * Return the current page title (for the content area)
     *
     * @return string
     */
    public function getTitle()
    {
        return 'U.S.P.S. settings';
    }

    /**
     * Returns options for PackageSize selector
     *
     * @return array
     */
    public function getPackageSizeOptions()
    {
        return array(
            'REGULAR'  => 'Regular (package dimensions are 12" or less)',
            'LARGE'    => 'Large (any package dimension is larger than 12")',
        );
    }

    /**
     * Returns options for MailType selector
     *
     * @return array
     */
    public function getMailTypeOptions()
    {
        return array(
            'Package'                  => 'Package',
            'Postcards or aerogrammes' => 'Postcards or aerogrammes',
            'Envelope'                 => 'Envelope',
            'LargeEnvelope'            => 'Large envelope',
            'FlatRate'                 => 'Flat rate',
        );
    }

    /**
     * Returns options for Container selector (domestic API)
     *
     * @return array
     */
    public function getContainerOptions()
    {
        return array(
            'VARIABLE'       => 'Variable',
            'FLAT RATE ENVELOPE' => 'Flat rate envelope',
            'PADDED FLAT RATE ENVELOPE' => 'Padded flat rate envelope',
            'LEGAL FLAT RATE ENVELOPE' => 'Legal flat rate envelope',
            'SM FLAT RATE ENVELOPE' => 'SM flat rate envelope',
            'WINDOW FLAT RATE ENVELOPE' => 'Window flat rate envelope',
            'GIFT CARD FLAT RATE ENVELOPE' => 'Gift card flat rate envelope',
            'FLAT RATE BOX' => ' Flat rate box',
            'SM FLAT RATE BOX' => 'SM flat rate box',
            'MD FLAT RATE BOX' => 'MD flat rate box',
            'LG FLAT RATE BOX' => 'LG flat rate box',
            'REGIONALRATEBOXA' => 'Regional rate boxA',
            'REGIONALRATEBOXB' => 'Regional rate boxB',
            'RECTANGULAR'    => 'Rectangular',
            'NONRECTANGULAR' => 'Non-rectangular',
        );
    }

    /**
     * Returns options for Container selector (international API)
     *
     * @return array
     */
    public function getContainerIntlOptions()
    {
        return array(
            'RECTANGULAR'    => 'Rectangular',
            'NONRECTANGULAR' => 'Non-rectangular',
        );
    }

    /**
     * getOptionsCategory
     *
     * @return string
     */
    protected function getOptionsCategory()
    {
        return 'CDev\USPS';
    }


    /**
     * Get shipping processor
     *
     * @return object
     */
    protected function getProcessor()
    {
        return new \XLite\Module\CDev\USPS\Model\Shipping\Processor\USPS();
    }

    /**
     * Get schema of an array for test rates routine
     *
     * @return array
     */
    protected function getTestRatesSchema()
    {
        $schema = parent::getTestRatesSchema();

        foreach (array('srcAddress', 'dstAddress') as $k) {
            unset($schema[$k]['city']);
            unset($schema[$k]['state']);
        }

        return $schema;
    }

    /**
     * Get input data to calculate test rates
     *
     * @param array $schema  Input data schema
     * @param array &$errors Array of fields which are not set
     *
     * @return array
     */
    protected function getTestRatesData(array $schema, &$errors)
    {
        $data = parent::getTestRatesData($schema, $errors);

        $config = \XLite\Core\Config::getInstance()->CDev->USPS;

        $package = array(
            'weight'    => $data['weight'],
            'subtotal'  => $data['subtotal'],
            'length'    => $config->length,
            'width'     => $config->width,
            'height'    => $config->height,
        );

        $data['packages'] = array($package);

        unset($data['weight']);
        unset($data['subtotal']);

        return $data;
    }
}
