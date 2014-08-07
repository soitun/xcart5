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

    // Loading data to the database from yaml file
    $yamlFile = __DIR__ . LC_DS . 'post_rebuild.yaml';

    if (\Includes\Utils\FileManager::isFileReadable($yamlFile)) {
        \XLite\Core\Database::getInstance()->loadFixturesFromYaml($yamlFile);
    }

    $yamlFile = LC_DIR_VAR . 'temporary.orders.yaml';

    $oldNew = array(
        'I'  => array('Q', 'N'),   // Incompleted
        'Q'  => array('Q', 'N'),   // Queued
        'A'  => array('A', 'N'),   // Authorized
        'P'  => array('P', 'P'),   // Processed
        'S'  => array('P', 'S'),   // Shipped
        'C'  => array('P', 'D'),   // Completed
        'CA' => array('C', 'WND'), // Canceled
        'F'  => array('D', 'WND'), // Failed
        'D'  => array('D', 'WND'), // Declined
        'E'  => array('D', 'WND'), // Expired
        'X'  => array('P', 'D'),   // Refund requested
        'Y'  => array('R', 'R'),   // Refunded
        'Z'  => array('PP', 'R'),  // Partially refunded
    );

    if (\Includes\Utils\FileManager::isFileReadable($yamlFile)) {
        $data = \Includes\Utils\Operator::loadServiceYAML($yamlFile);
        if ($data) {
            if ($data['orders']) {
                foreach ($data['orders'] as $id => $status) {
                    $order = \XLite\Core\Database::getRepo('XLite\Model\Order')->find($id);
                    if ($order) {
                        $order->setPaymentStatus($oldNew[$status][0]);
                        $order->setShippingStatus($oldNew[$status][1]);
                        $description = 'During the upgrade status was changed from "'
                            . $data['statuses'][$status]
                            . '" (single status) to "'
                            . $order->getPaymentStatus()->getName()
                            . '" (payment status) and "'
                            . $order->getShippingStatus()->getName()
                            . '" (shipping status)';

                        $event = new \XLite\Model\OrderHistoryEvents(
                            array(
                                'date'         => \XLite\Core\Converter::time(),
                                'code'         => \XLite\Core\OrderHistory::CODE_CHANGE_STATUS_ORDER,
                                'description'  => $description,
                                'data'         => array(),
                                'comment'      => '',
                            )
                        );
                        $event->setOrder($order);
                        $order->addEvents($event);
                        \XLite\Core\Database::getRepo('XLite\Model\OrderHistoryEvents')->insert($event);

                        $order->update();
                    }
                }
            }
        }
        \Includes\Utils\FileManager::deleteFile($yamlFile);
    }
};
