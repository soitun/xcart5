{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Subcategories count link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.category.cell.subcategories", weight="100")
 *}

<a href="{buildURL(#categories#,##,_ARRAY_(#id#^entity.getCategoryId()))}" class="count-link">{entity.getSubcategoriesCount()}</a>
