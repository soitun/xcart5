{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Review block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="reviews.review.title", weight="100")
 *}
<div class="info">
  <div class="reviewer-name">
    <span IF={review.getReviewerName()}>{review.getReviewerName()}</span>
    <span IF={!review.getReviewerName()}>{t(#Customer#)}</span>
  </div>
  <div class="date">
    {formatTime(review.getAdditionDate())}
  </div>
</div>
<div IF="{isOwnReview(review)}" class="separator"></div>
<div IF="{!isOnModeration(review)}" class="approved-separator"></div>
