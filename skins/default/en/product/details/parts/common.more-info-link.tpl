{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product details title main block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.details.quicklook.info", weight="12")
 *}

<a href="{buildURL(#product#,##,_ARRAY_(#product_id#^product.product_id,#category_id#^getCategoryId()))}" class="product-more-link">{t(#More details#)}</a>
