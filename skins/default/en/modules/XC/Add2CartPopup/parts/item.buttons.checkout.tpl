{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add to Cart popup page: Added product's price template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="add2cart_popup.item.buttons", weight="200")
 *}

<widget IF="cart.checkCart()" class="\XLite\View\Button\Link" label="Checkout" location="{buildURL(#checkout#)}" style="regular-main-button checkout" />
<widget IF="!cart.checkCart()" class="\XLite\View\Button\Link" label="Checkout" location="{buildURL(#checkout#)}" style="regular-main-button checkout" disabled="true" />

