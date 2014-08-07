{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Read all reviews link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.reviews.tab", weight="500")
 *}
<div class="link">
  <div class="line"></div>
  <a href="{buildURL(#product_reviews#,##,_ARRAY_(#product_id#^product.getProductId(),#category_id#^product.getCategoryId()))}">{t(#Read all reviews about the product#)}</a>
</div>
