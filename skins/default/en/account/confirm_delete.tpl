{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Delete confirmation template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="delete-profile-message">
  {t(#This operation is irreversible. Are you sure you want to proceed?#)}
</div>

<form action="{buildURL()}" method="post" name="delete_account_form">
  <input type="hidden" name="target" value="profile" />
  <input type="hidden" name="action" value="delete" />
  <widget class="\XLite\View\FormField\Input\FormId" />

  <div class="delete-user-buttons-list">
    <widget class="\XLite\View\Button\Submit" label="Proceed" style="button-proceed" />

    <widget class="\XLite\View\Button\Regular" label="Cancel" jsCode="void(0);" style="button-cancel" />
  </div>

</form>
