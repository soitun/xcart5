{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product details buttons block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.details.page.info.buttons", weight="10")
 * @ListChild (list="product.details.page.info.buttons-added", weight="10")
 * @ListChild (list="product.details.quicklook.info.buttons", weight="20")
 * @ListChild (list="product.details.quicklook.info.buttons-added", weight="20")
 *}

<div class="buttons-row" IF="isProductAvailableForSale()">
  <list name="cart-buttons" type="nested" />
</div>
