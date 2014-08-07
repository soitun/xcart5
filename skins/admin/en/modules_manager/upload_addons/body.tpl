{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules upload form
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="upload-addons-text">
  {t(#If you have a plugin in the .tar format, you can install it by uploading it here#)}.
</div>

<div class="upload-addon-form">

<form action="{buildURL()}" method="post" name="uploadAddonsForm" enctype="multipart/form-data">
  <input type="hidden" name="target" value="upgrade" />
  <input type="hidden" name="action" value="upload_addon" />
  <widget class="\XLite\View\FormField\Input\FormId" />

  <div class="upload-area">
    <input type="file" name="modulePack" />
  </div>

  <div class="buttons">
  <widget class="\XLite\View\Button\Submit" style="main-button" label="{t(#Install add-on#)}" />
  </div>

</form>

</div>
