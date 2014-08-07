{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Review block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="reviews.review", weight="200")
 *}
<div class="rating clearfix">
  <widget  class="\XLite\Module\XC\Reviews\View\VoteBar" rate="{review.getRating()}" max="5" />
</div>
