{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Clear bag button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="cart.buttons", weight="20")
 *}
<widget class="\XLite\View\Form\Cart\Clear" name="clearCart" />
  <div>
    <a
      href="{buildURL(#cart#,#clear#)}"
      onclick="javascript: return confirm('{t(#You are sure to clear your cart?#)}') && !jQuery(this).parents('form').eq(0).submit();"
      class="clear-bag">{t(#Clear bag#)}</a>
  </div>
<widget name="clearCart" end />
