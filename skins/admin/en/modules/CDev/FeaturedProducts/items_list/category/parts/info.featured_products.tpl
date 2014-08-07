{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Featured products count link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.category.cell.featured_products", weight="100")
 *}

<i class="fa fa-star"></i>
<a href="{buildURL(#featured_products#,##,_ARRAY_(#id#^entity.getCategoryId()))}" class="count-link">{entity.getFeaturedProductsCount()}</a>
