{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product info on product reviews page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.reviews.page", weight="100")
 *}

<div class="product-details clearfix" IF="{product}">
  <div class="image{if:!product.hasImage()} empty{end:}" style="width: {getMaxImageWidth()}px;">
    <widget class="\XLite\View\Product\Details\Customer\Image" product="{product}" />
  </div>
  <div class="product-details-info">
    <h1 class="fn title">{product.name:h}</h1>
    <a href="{buildURL(#product#,##,_ARRAY_(#product_id#^getProductId(),#category_id#^getCategoryId()))}">{t(#Back to product details#)}</a>

    <div>
      <widget class="XLite\Module\XC\Reviews\View\Customer\ReviewsPage\AverageRating" product="{product}" />
    </div>
  </div>

</div>
