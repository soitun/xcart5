{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Labels list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.grid.customer.info", weight="998")
 * @ListChild (list="itemsList.product.small_thumbnails.customer.details", weight="30")
 * @ListChild (list="itemsList.product.list.customer.photo", weight="998")
 * @ListChild (list="itemsList.product.table.customer.columns", weight="45")
 * @ListChild (list="itemsList.product.big_thumbnails.customer.info", weight="998")
 * @ListChild (list="productBlock.info.photo", weight="998")
 *}

<widget class="\XLite\View\Labels" labels="{getLabels(product)}" />
