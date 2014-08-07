{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Renew settings dialog template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="admin-title">Australia Post settings</div>

<br />

<p>{t(#Before you can start configure Australia Post module you should update available options from Australia Post. Please click button below.#)}</p>

<br />

<form action="{buildURL()}" method="post">

  <input type="hidden" name="target" value="aupost" />
  <input type="hidden" name="action" value="renew_settings" />
  <widget class="\XLite\View\FormField\Input\FormId" />

  <widget class="\XLite\View\Button\Submit" label="Get module settings" style="main-button" />

</form>
