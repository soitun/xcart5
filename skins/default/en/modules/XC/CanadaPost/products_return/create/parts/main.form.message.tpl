{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Create return :: form :: message
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="capost_create_return.form", weight="200")
 *}

<div class="return-message">

  <label for="message" class="for-message">
    {t(#Message#)}
    <span class="form-required" title="{t(#This field is required.#)}">*</span>
  </label>

  <div class="resizable-textarea">
    <widget class="XLite\View\FormField\Textarea\Simple" placeholder="Your Message" fieldName="message" value="" fieldOnly="true" required="true" />
  </div>

</div>
