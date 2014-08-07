{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Core version select popup
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<form action="{buildURL()}" method="post">
  <input type="hidden" name="target" value="upgrade" />
  <input type="hidden" name="action" value="select_core_version" />
  
  <widget class="\XLite\View\FormField\Input\FormId" />

  <div class="upgrade-core-frame">
    <list name="upgrade.selector-version.details" />
  </div>

</form>
