{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Message
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="contact-us.send.fields", weight="400")
 *}

<div class="form-item">
  <label for="message" class="for-message">
    {t(#Message#)}
    <span class="form-required" title="{t(#This field is required.#)}">*</span>
  </label>
  <div class="resizable-textarea">
    <widget class="XLite\View\FormField\Textarea\Simple" placeholder="{t(#Your Message#)}" fieldName="message" value="{getValue(#message#)}" fieldOnly="true" required="true" />
  </div>
</div>
