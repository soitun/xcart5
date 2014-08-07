{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Rating
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="reviews.product.rating.form.content", weight="100")
 *}

<div class="rating{if:isAllowedRateProduct()} edit{end:}" IF="{isVisibleAverageRatingOnPage()}">
  <widget
      class="\XLite\Module\XC\Reviews\View\FormField\Input\Rating"
      IF="{isAllowedRateProduct()}"
      fieldName="rating"
      rate="{getAverageRating()}"
      is_editable="{isAllowedRateProduct()}"
      max="5" />
  <widget  class="\XLite\Module\XC\Reviews\View\VoteBar" IF="{!isAllowedRateProduct()}" rate="{getAverageRating()}" max="5" />
  <br />

  <div class="rating-tooltip">
    <list name="reviews.tooltip.rating" />
  </div>

</div>
