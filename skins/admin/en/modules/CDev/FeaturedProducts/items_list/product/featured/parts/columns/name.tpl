{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Item name
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.admin.featured.columns", weight="30")
 *}

<td><a class="name" href="{buildURL(#product#,##,_ARRAY_(#product_id#^product.getProductId()))}">{if:product.getName()}{product.getName():h}{else:}N/A{end:}</a></td>
