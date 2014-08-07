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

namespace XLite\Model\Shipping\Processor;

/**
 * Shipping processor model
 */
class Offline extends \XLite\Model\Shipping\Processor\AProcessor
{
    /*
     * Default base rate
     */
    const PROCESSOR_DEFAULT_BASE_RATE = 0;

    /**
     * Unique processor Id
     *
     * @var string
     */
    protected $processorId = 'offline';

    /**
     * getProcessorName
     *
     * @return string
     */
    public function getProcessorName()
    {
        return 'Custom offline shipping';
    }

    /**
     * Enable admin to remove offline shipping methods
     *
     * @return boolean
     */
    public function isMethodDeleteEnabled()
    {
        return true;
    }

    /**
     * Returns offline shipping rates
     *
     * @param \XLite\Logic\Order\Modifier\Shipping $modifier    Shipping order modifier
     * @param boolean                              $ignoreCache Flag: if true then do not get rates from cache (not used in offline processor) OPTIONAL
     *
     * @return array
     */
    public function getRates($modifier, $ignoreCache = false)
    {
        $rates = array();

        if ($modifier instanceOf \XLite\Logic\Order\Modifier\Shipping) {

            // Find markups for all enabled offline shipping methods
            $markups = \XLite\Core\Database::getRepo('XLite\Model\Shipping\Markup')
                ->findMarkupsByProcessor($this->getProcessorId(), $modifier);

            if (!empty($markups)) {

                // Create shipping rates list
                foreach ($markups as $markup) {
                    $rate = new \XLite\Model\Shipping\Rate();
                    $rate->setMethod($markup->getShippingMethod());
                    $rate->setBaseRate(self::PROCESSOR_DEFAULT_BASE_RATE);
                    $rate->setMarkup($markup);
                    $rate->setMarkupRate($markup->getMarkupValue());
                    $rates[] = $rate;
                }
            }
        }

        // Return shipping rates list
        return $rates;
    }

    /**
     * Returns true if shipping methods named may be modified by admin
     *
     * @return boolean
     */
    public function isMethodNamesAdjustable()
    {
        return true;
    }

}
