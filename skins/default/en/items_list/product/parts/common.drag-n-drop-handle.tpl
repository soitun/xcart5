{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Overlapping box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.grid.customer.info", weight="0")
 * @ListChild (list="itemsList.product.list.customer.info", weight="0")
 * @ListChild (list="itemsList.product.small_thumbnails.customer.info", weight="first")
 * @ListChild (list="itemsList.product.big_thumbnails.customer.info", weight="first")
 *}

<div class="drag-n-drop-handle">
  <span class="drag-message">{t(#Drag and drop me to the bag#)}</span>
  <span class="out-message">{t(#Product is out of stock#)}</span>
  <span class="choose-product-option">{t(#Choose the product options first#)}</span>
</div>
