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

namespace XLite\Core\EventListener;

/**
 * Import
 */
class Import extends \XLite\Core\EventListener\Base\Countable
{
    const CHUNK_LENGTH = 10;

    /**
     * Importer
     *
     * @var \XLite\Logic\Import\Importer
     */
    protected $importer;

    /**
     * Time mark
     *
     * @var integer
     */
    protected $timeMark = 0;

    /**
     * Service time
     *
     * @var integer
     */
    protected $serviceTime = 0;

    /**
     * Get event name
     *
     * @return string
     */
    protected function getEventName()
    {
        return 'import';
    }

    /**
     * Process item
     *
     * @param mixed $item Item
     *
     * @return boolean
     */
    protected function processItem($item)
    {
        $this->serviceTime += (microtime(true) - $this->timeMark);

        if (0 === $item->current()->key()) {
            $item->current()->seek($this->record['position']);
        }
        $item->current()->process();
        $this->record['position'] = $item->current()->key();

        $this->timeMark = microtime(true);

        return true;
    }

    /**
     * Check step valid state
     *
     * @return boolean
     */
    protected function isStepValid()
    {
        return parent::isStepValid()
            && $this->getItems()->valid();
    }

    /**
     * Get images list length
     *
     * @return integer
     */
    protected function getLength()
    {
        return $this->getItems()->count() - 1;
    }

    /**
     * Get items
     *
     * @return array
     */
    protected function getItems()
    {
        if (!isset($this->importer)) {
            $this->importer = new \XLite\Logic\Import\Importer(isset($this->record['options']) ? $this->record['options'] : array());
        }

        return $this->importer->getStep();
    }

    /**
     * Initialize step
     *
     * @return void
     */
    protected function initializeStep()
    {
        $this->timeMark = microtime(true);

        set_time_limit(0);
        $this->counter = static::CHUNK_LENGTH;

        parent::initializeStep();
    }

    /**
     * Finish step
     *
     * @return void
     */
    protected function finishStep()
    {
        $step = $this->getItems();

        $this->serviceTime += (microtime(true) - $this->timeMark);
        $step->getOptions()->time += $this->serviceTime;

        $this->record['options'] = $step->getOptions()->getArrayCopy();
        $this->record['touchData'] = array();

        if (0 < ($step->getOptions()->errorsCount + $step->getOptions()->warningsCount)) {
            $label = static::t(
                'Rows processed: X of Y with errors',
                array(
                    'X'      => $step->getOptions()->position,
                    'Y'      => $step->getOptions()->rowsCount,
                    'errors' => $step->getOptions()->errorsCount,
                    'warns'  => $step->getOptions()->warningsCount,
                )
            );

        } else {
            $label = static::t(
                'Rows processed: X of Y',
                array(
                    'X' => $step->getOptions()->position,
                    'Y' => $step->getOptions()->rowsCount
                )
            );
        }

        $this->record['touchData']['rowsProcessedLabel'] = $label;

        parent::finishStep();
    }

    /**
     * Finish task
     *
     * @return void
     */
    protected function finishTask()
    {
        $this->record['options'] = $this->getItems()->getOptions()->getArrayCopy();

        parent::finishTask();

        $this->getItems()->finalize();
    }

    /**
     * Check - step is success or not
     *
     * @return boolean
     */
    protected function isStepSuccess()
    {
        return parent::isStepSuccess()
            && (
               0 == $this->getItems()->getOptions()->step
               || !$this->getItems()->hasErrors()
            );
    }

    /**
     * Check - continue cycle or not
     *
     * @param mixed $item Item
     *
     * @return boolean
     */
    protected function isContinue($item)
    {
        $this->counter--;

        return parent::isContinue($item) && 0 < $this->counter && empty($this->errors);
    }

    /**
     * Fail task
     *
     * @return void
     */
    protected function failTask()
    {
        parent::failTask();

        \XLite\Core\Database::getRepo('XLite\Model\TmpVar')->removeEventState($this->getEventName());
    }

}

