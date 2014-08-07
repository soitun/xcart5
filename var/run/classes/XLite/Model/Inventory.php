<?php

namespace XLite\Model;

/**
 * Product inventory
 *
 * @Entity (repositoryClass="\XLite\Model\Repo\Base\Common")
 * @Table  (name="inventory",
 *      indexes={
 *          @Index (name="id", columns={"id"})
 *      }
 * )
 *
 * 
 */
class Inventory extends \XLite\Module\CDev\Wholesale\Model\Inventory
{
}