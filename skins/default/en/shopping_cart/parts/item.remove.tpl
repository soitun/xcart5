{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shopping cart item : main
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="cart.item", weight="10")
 *}
<td class="item-remove delete-from-list">
  <widget class="\XLite\View\Form\Cart\Item\Delete" name="itemRemove{item.getItemId()}" item="{item}" />
    <div><widget class="\XLite\View\Button\Image" label="Delete item" style="remove" jsCode="return jQuery(this).closest('form').submit();" /></div>
  <widget name="itemRemove{item.getItemId()}" end />
</td>
