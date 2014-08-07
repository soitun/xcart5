{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Vote bar
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="vote-bar{if:isEditable()} editable{end:}">

  <div class="stars-row">
    <div FOREACH="getStarsCount(),num" class="star-single"><span class="fa fa-star"><span></div>
  </div>

  <div class="stars-row full" style="width: {getPercent()}%;">
    <div FOREACH="getStarsCount(),num" class="star-single"><span class="fa fa-star"><span></div>
  </div>

  {if:isEditable()}
  <div class="stars-row hovered" style="display: none;">
    <div FOREACH="getStarsCount(),num" class="star-single star-num-{num}"><span class="fa fa-star"><span></div>
  </div>

  <input type="hidden" name="{getFieldName()}" value="{getRating()}" />
  {end:}

</div>
