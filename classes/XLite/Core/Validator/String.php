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

namespace XLite\Core\Validator;

/**
 * String
 */
class String extends \XLite\Core\Validator\Scalar
{
    /**
     * Non-empty validation flag
     *
     * @var mixed
     */
    protected $nonEmpty = false;

    /**
     * Constructor
     *
     * @param boolean $nonEmpty Non-empty flag OPTIONAL
     *
     * @return void
     */
    public function __construct($nonEmpty = false)
    {
        parent::__construct();

        $this->markAsNonEmpty($nonEmpty);
    }

    /**
     * Mark validator as requried non-empty
     *
     * @param boolean $nonEmpty Flag OPTIONAL
     *
     * @return void
     */
    public function markAsNonEmpty($nonEmpty = true)
    {
        $this->nonEmpty = $nonEmpty;
    }

    /**
     * Validate
     *
     * @param mixed $data Data
     *
     * @return void
     * @throws \XLite\Core\Validator\Exception
     */
    public function validate($data)
    {
        if (!is_string($data)) {
            throw $this->throwError('Not a string');
        }

        if ($this->nonEmpty && 0 == strlen($data)) {
            throw $this->throwError('Value is empty');
        }

    }
}
