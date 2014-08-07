{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Prices
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="comparison_table.data", weight="100")
 *}

<tr class="prices">
  <td class="title">{t(#Price#)}</td>
  <td FOREACH="getProducts(),product">{formatPrice(product.getDisplayPrice()):h}</td>
</tr>
