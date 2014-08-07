{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Quantity in stock input
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.inventory.parts", weight="20")
 *}

<tr IF="product.hasManualPinCodes()">
  <td>{t(#Quantity in stock#)}</td>
  <td>{product.getRemainingPinCodesCount()} ({t(#Quantity in stock is determined by the amount of the remaining PIN codes#)})</td>
</tr>

<widget IF="!product.hasManualPinCodes()" template="product/inventory/inv_track_amount.tpl" />
