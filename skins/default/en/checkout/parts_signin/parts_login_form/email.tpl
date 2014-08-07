{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Sign-in
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="checkout.signin.form", weight="10")
 *}
<tr><td class="email-field">
  <widget class="XLite\View\FormField\Input\Text\Email" value="{login}" required="true" fieldName="login" placeholder="{t(#Email#)}" label="{t(#Email#)}" fieldOnly="true" fieldId="login-email" />
</td></tr>
