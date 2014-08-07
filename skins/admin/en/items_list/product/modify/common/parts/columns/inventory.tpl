{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Item price
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.modify.common.admin.columns", weight="70")
 *}

<td>
  <input type="text" class="inventory{if:!product.inventory.getEnabled()} input-disabled{end:}" size="10" value="{product.inventory.getAmount():r}" name="{getNamePostedData(#amount#,product.getProductId())}" disabled="{!product.inventory.getEnabled()}" />
</td>
