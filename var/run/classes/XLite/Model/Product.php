<?php

namespace XLite\Model;

/**
 * The "product" model class
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Product")
 * @Table  (name="products",
 *      indexes={
 *          @Index (name="sku", columns={"sku"}),
 *          @Index (name="price", columns={"price"}),
 *          @Index (name="weight", columns={"weight"}),
 *          @Index (name="free_shipping", columns={"free_shipping"}),
 *          @Index (name="customerArea", columns={"enabled","arrivalDate"})
 *      }
 * )
 * 
 */
class Product extends \XLite\Module\XC\Upselling\Model\Product implements \XLite\Model\Base\IOrderItem
{
}