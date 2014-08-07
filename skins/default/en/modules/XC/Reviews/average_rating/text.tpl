{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Rating value in text
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="reviews.page.rating", weight="200")
 * @ListChild (list="reviews.tooltip.rating", weight="200")
 *}
<div class="text">
  <div>{t(#Average rating#)}: {getAverageRating()} {t(#out of#)} {getMaxRatingValue()}</div>
  <div>{t(#Based on#)} {getVotesCount()} {t(#votes#)}</div>
</div>
