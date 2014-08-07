{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add to cart
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:product.inventory.isOutOfStock()}
<span class="out-of-stock">
  {t(#Out of stock#)}
</span>
{else:}
  <widget class="\XLite\View\Form\Product\AddToCart" name="add2cart" product="{product}" />
  <widget class="\XLite\View\Button\Submit" label="Add to cart" style="regular-main-button add2cart" />
<widget name="add2cart" end />
{end:}
