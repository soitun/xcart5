{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Reviewer (email and name)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="review.modify.fields", weight="300")
 *}
<li class="input clearfix">
  <div class="table-label">
    <label for="profile" class="email">{t(#Profile#)}</label>
  </div>

  <div class="star">&nbsp;</div>

  <div class="wrapper-table-value">
    {if:entity.profile}
    <widget
      class="\XLite\View\FormField\Select\Model\ProfileSelector"
      fieldOnly="true"
      fieldName="profile"
      placeholder="{t(#Start typing customer email or name#)}"
      is_model_required="false"
      value="{entity.profile.getProfileId()}" />
    {else:}
    <widget
      class="\XLite\View\FormField\Select\Model\ProfileSelector"
      fieldOnly="true"
      fieldName="profile"
      placeholder="{t(#Start typing customer email or name#)}"
      is_model_required="false"
      value="" />
    {end:}
  </div>
</li>
