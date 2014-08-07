{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list (list variant)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.grid.customer.info", weight="10")
 * @ListChild (list="itemsList.product.small_thumbnails.customer.info", weight="10")
 * @ListChild (list="itemsList.product.big_thumbnails.customer.info", weight="100")
 *}
<div class="product-photo">
  <list name="photo" type="nested" product="{product}" />
</div>
