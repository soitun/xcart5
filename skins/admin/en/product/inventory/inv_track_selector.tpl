{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.inventory.parts", weight="10")
 *}

<tr>
  <td>{t(#Inventory tracking for this product is#)}</td>
  <td>
    <select name="{getNamePostedData(#enabled#)}">
      <option value="1" selected="{inventory.getEnabled()=#1#}">{t(#Enabled#)}</option>
      <option value="0" selected="{inventory.getEnabled()=#0#}">{t(#Disabled#)}</option>
    </select>
  </td>
</tr>
