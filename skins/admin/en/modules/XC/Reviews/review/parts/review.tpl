{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Review
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="review.modify.fields", weight="500")
 *}
<li class="input review-text clearfix">
  <div class="table-label">
    <label for="review" class="review">{t(#Text of review#)}</label>
  </div>

  <div class="star">&nbsp;</div>

  <div class="wrapper-table-value">
    <widget
      class="\XLite\View\FormField\Textarea\Simple"
      fieldOnly="true"
      fieldName="review"
      cols="60"
      rows="5"
      value="{entity.review}" />
  </div>

</li>
