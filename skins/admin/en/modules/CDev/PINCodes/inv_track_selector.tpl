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

<tr IF="product.hasManualPinCodes()">
  <td>{t(#Inventory tracking for this product is#)}</td>
  <td>{t(#Enabled#)} ({t(#Can not be disabled for products with manually defined PIN codes#)})</td>
</tr>

<widget IF="!product.hasManualPinCodes()" template="product/inventory/inv_track_selector.tpl" />
