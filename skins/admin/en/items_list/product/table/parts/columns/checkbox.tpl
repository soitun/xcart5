{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Column with checkboxes
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.table.admin.search.columns", weight="10")
 *}

<td><input type="checkbox" class="checkbox {product.getProductId()}" value="1" name="{getNameToDelete(product.getProductId())}" /></td>
