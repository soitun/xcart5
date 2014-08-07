{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.inventory.parts", weight="30")
 *}

<tr>
  <td>{t(#Low limit notification for this product is#)}</td>
  <td>
    <select name="{getNamePostedData(#lowLimitEnabled#)}">
      <option value="1" selected="{inventory.getLowLimitEnabled()=#1#}">{t(#Enabled#)}</option>
      <option value="0" selected="{inventory.getLowLimitEnabled()=#0#}">{t(#Disabled#)}</option>
    </select>
  </td>
</tr>
