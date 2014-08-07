{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add to Cart popup page: products list box template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="add2cart_popup.products", weight="300")
 *}

<div IF="isProductsListEnabled()" class="products-list-box">

  <widget class="\XLite\Module\XC\Add2CartPopup\View\Products" product="{product}" />

  <list name="add2cart_popup.products.ext" />

</div>
