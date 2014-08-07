{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Review management buttons
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="reviews.review.title", weight="200")
 *}
<div class="right-actions">
  <div IF="{isOnModeration(review)}" class="moderation">{t(#On moderation#)}</div>
  <div IF="{isOwnReview(review)}" class="separator"></div>
  <div IF="{isOwnReview(review)}" class="buttons">
    <widget class="\XLite\Module\XC\Reviews\View\Button\Customer\EditReview" label=" " review="{review}" />
  </div>
</div>
