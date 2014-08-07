<?php

namespace XLite\Model\Payment;

/**
 * Payment method
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Payment\Method")
 * @Table  (name="payment_methods",
 *      indexes={
 *          @Index (name="orderby", columns={"orderby"}),
 *          @Index (name="class", columns={"class","enabled"}),
 *          @Index (name="enabled", columns={"enabled"})
 *      }
 * )
 */
class Method extends \XLite\Module\CDev\Paypal\Model\Payment\Method
{
}