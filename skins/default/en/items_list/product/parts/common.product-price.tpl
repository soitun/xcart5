{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Item price
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.grid.customer.info", weight="30")
 * @ListChild (list="itemsList.product.small_thumbnails.customer.details", weight="25")
 * @ListChild (list="itemsList.product.list.customer.info", weight="40")
 * @ListChild (list="itemsList.product.table.customer.columns", weight="40")
 * @ListChild (list="productBlock.info", weight="300")
 *}

<widget class="\XLite\View\Price" product="{product}" displayOnlyPrice="true" />
