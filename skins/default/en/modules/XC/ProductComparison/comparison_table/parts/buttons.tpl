{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="comparison_table.header_fixed", weight="200")
 *}

<tr class="buttons">
  <td>
    <input type="checkbox" id="diff" /><label for="diff">{t(#Differences only#)}</label>
  </td>
  <td FOREACH="getProducts(),product">
    <widget class="\XLite\Module\XC\ProductComparison\View\AddToCart" product="{product}" />
  </td>
</tr>
