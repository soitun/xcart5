{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Reviewer name
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="review.add.fields", weight="200")
 *}
<div class="form-item clearfix">
  <widget
      class="\XLite\View\FormField\Input\Text"
      placeholder="{t(#Full name#)}"
      fieldName="reviewerName"
      label="{t(#Your name#)}"
      value="{review.reviewerName}" />
</div>
