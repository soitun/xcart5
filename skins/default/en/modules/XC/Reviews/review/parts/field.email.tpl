{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * E-mail
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="review.add.fields", weight="300")
 *}
<div class="form-item clearfix">

  <div class="icon-help-container"><label for="email" class="email">{t(#Your email#)}</label></div>
  <div id="icon_help" class="icon-help">&nbsp;</div>
  <div id="icon_help_tooltip" class="tooltip">
    {t(#We use this email in case we need additional information on your review. We do not use it for any kind of mailing lists or spam subscriptions#)}
  </div>

  <widget
    class="XLite\View\FormField\Input\Text\Email"
    fieldName="email"
    placeholder="{t(#Email address#)}"
    value="{review.email}"
    fieldOnly="true" />

</div>
