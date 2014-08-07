{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Checkout : order review step : items : list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="checkout.review.selected.items", weight="20")
 * @ListChild (list="checkout.review.inactive.items", weight="20")
 *}
<div class="list" style="display: none;">

  <ul>
    <li FOREACH="cart.getItems(),item">
      <a href="{item.getURL()}">{item.getName()}<img src="images/spacer.gif" alt="" class="fade" /></a>
      <div>
        &times;
        <span class="qty">{item.getAmount()}</span>
      </div>
    </li>
  </ul>

  <hr />
  <a href="{buildURL(#cart#)}" class="cart">{t(#View cart#)}</a>
</div>
