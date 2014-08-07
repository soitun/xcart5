<?php

namespace XLite\Model;

/**
 * Class represents an order
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Order")
 * @Table  (name="orders",
 *      indexes={
 *          @Index (name="date", columns={"date"}),
 *          @Index (name="total", columns={"total"}),
 *          @Index (name="subtotal", columns={"subtotal"}),
 *          @Index (name="tracking", columns={"tracking"}),
 *          @Index (name="payment_status", columns={"payment_status_id"}),
 *          @Index (name="shipping_status", columns={"shipping_status_id"}),
 *          @Index (name="shipping_id", columns={"shipping_id"})
 *      }
 * )
 *
 * 
 * @InheritanceType       ("SINGLE_TABLE")
 * @DiscriminatorColumn   (name="is_order", type="integer", length=1)
 * @DiscriminatorMap      ({1 = "XLite\Model\Order", 0 = "XLite\Model\Cart"})
 */
class Order extends \XLite\Module\XC\CanadaPost\Model\Order
{
}