{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Subject
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="contact-us.send.fields", weight="300")
 *}

<div class="form-item">
  <label for="subject">
    {t(#Subject#)}
    <span class="form-required" title="{t(#This field is required.#)}">*</span>
  </label>
  <widget class="XLite\View\FormField\Input\Text" fieldName="subject" placeholder="{t(#Subject#)}" value="{getValue(#subject#)}" fieldOnly="true" required="true" />
</div>
