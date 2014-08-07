{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Rating of reviews
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="reviews.page.rating", weight="300")
 * @ListChild (list="reviews.rating.details", weight="200")
 *}
<div class="ratings-details" IF="{isVisibleAverageRating()}">
  <div class="title">
    {t(#Rating of votes#)} ({getVotesCount()})
  </div>
  <table>
    <tr FOREACH="getRatings(),rating" class="rating-{rating.rating}">
      <td class="indent"></td>
      <td class="rating">{rating.rating}</td>
      <td class="rating"><widget class="\XLite\Module\XC\Reviews\View\VoteBar" rate="1" max="1" length="1" /></td>
      <td class="percent"><div class="rating-{rating.rating}" style="width:{rating.percent}%">&nbsp;</div><div IF="rating.showPercentLastDiv" class="rating-end">&nbsp;</div></td>
      <td class="count">{rating.count} {t(#customers#)}</td>
    </tr>
    <tr><td colspan="5">&nbsp;</td></tr>
  </table>

</div>
