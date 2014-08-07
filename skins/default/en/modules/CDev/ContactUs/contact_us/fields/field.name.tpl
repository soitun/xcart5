{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Name
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="contact-us.send.fields", weight="100")
 *}

<div class="form-item">
  <label for="name">
    {t(#Your name#)}
    <span class="form-required" title="{t(#This field is required.#)}">*</span>
  </label>
  <widget class="XLite\View\FormField\Input\Text" placeholder="{t(#Full Name#)}" fieldName="name" value="{getValue(#name#)}" fieldOnly="true" required="true" />
</div>
