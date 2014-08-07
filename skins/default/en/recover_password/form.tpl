{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Recover password : form
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="recover.password", weight="200")
 *}

<widget class="XLite\View\Form" formTarget="recover_password" formAction="recover_password" className="recovery-form use-inline-error" name="recoveryForm" />

  <table class="recover-password-form">
    <list name="recover.password.fields" />
  </table>

<widget name="recoveryForm" end />

