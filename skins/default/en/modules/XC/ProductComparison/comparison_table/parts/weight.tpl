{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Weight 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="comparison_table.data", weight="200")
 *}

<tr class="weight">
  <td class="title">{t(#Weight#)}</td>
  <td FOREACH="getProducts(),product">{product.getWeight()} {getWeightSymbol()}</td>
</tr>
