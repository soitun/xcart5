{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Item buttons
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.table.customer.columns", weight="50")
 *}

{if:product.isUpcomingProduct()}
  <widget class="\XLite\View\Button\Image" label="Coming soon" jsCode="return false;" />
{else:}
  {if:product.inventory.isOutOfStock()}
    <widget class="\XLite\View\Button\Image" label="Out of stock" jsCode="return false;" />
  {else:}
    <widget class="\XLite\View\Button\Image" style="add-to-cart product-add2cart productid-{product.product_id}" label="Add to cart" jsCode="return false;" />
  {end:}
{end:}
