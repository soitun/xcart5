{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shopping cart subtotal
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="cart.totals", weight="10")
 * @ListChild (list="cart.panel.totals", weight="10")
 *}
<li class="subtotal">
  <strong>{t(#Subtotal#)}:</strong>
  <span class="cart-subtotal{if:cart.getItemsIncludeSurchargesTotals()} modified-subtotal{end:}"><widget class="XLite\View\Surcharge" surcharge="{cart.getSubtotal()}" currency="{cart.getCurrency()}" /></span>
  <div IF="cart.getItemsIncludeSurchargesTotals()" class="including-modifiers" style="display: none;">
    <table class="including-modifiers" cellspacing="0">
      <tr FOREACH="cart.getItemsIncludeSurchargesTotals(),row">
        <td class="name">{t(#Including X#,_ARRAY_(#name#^row.surcharge.getName()))}:</td>
        <td class="value"><widget class="XLite\View\Surcharge" surcharge="{row.cost}" currency="{cart.getCurrency()}" /></td>
      </tr>
    </table>
  </div>
</li>
