{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Review
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="review.add.fields", weight="400")
 *}
<div class="form-item clearfix">
  <label for="review" class="review">
    {t(#Write your review#)}
  </label>
  <br />
  <widget
      class="\XLite\View\FormField\Textarea\Simple"
      placeholder="{t(#Your review#)}"
      fieldOnly="true"
      fieldName="review"
      rows="6"
      cols="78"
      value="{review.review}" />

</div>
