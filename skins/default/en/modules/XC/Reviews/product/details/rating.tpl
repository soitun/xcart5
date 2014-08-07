{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Rating value in product info
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="reviews.product.rating.average", weight="100")
 *}
<div class="product-average-rating" IF="{isVisibleAverageRatingOnPage()}">
  <input type="hidden" name="target_widget" value="\XLite\Module\XC\Reviews\View\Customer\ProductInfo\Details\AverageRating" />
  <list name="reviews.product.rating" product="{getRatedProduct()}" />
  <div class="reviews-count">
    <a href="{buildURL(#product#,##,_ARRAY_(#product_id#^getRatedProductId(),#category_id#^product.category_id))}#product-details-tab-reviews">
      {t(#X reviews#,_ARRAY_(#count#^getReviewsCount()))}
    </a>
  </div>
</div>
