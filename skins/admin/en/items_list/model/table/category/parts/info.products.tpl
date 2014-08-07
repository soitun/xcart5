{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products count
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.category.cell.info", weight="100")
 *}

<a href="{buildURL(#category_products#,##,_ARRAY_(#id#^entity.getCategoryId()))}"class="count-link">{entity.countProducts()}</a>
