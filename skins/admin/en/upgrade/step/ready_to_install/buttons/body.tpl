{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Form buttons
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<form action="{buildURL()}" method="post">
  <input type="hidden" name="target" value="upgrade" />
  <input type="hidden" name="action" value="install_upgrades" />

  <widget class="\XLite\View\FormField\Input\FormId" />

  <widget class="\XLite\View\Upgrade\Step\ReadyToInstall\DisabledModulesHooks" />

  <widget class="\XLite\View\Upgrade\Step\ReadyToInstall\PreUpgradeWarningModules" />

  <widget class="\XLite\View\Upgrade\Step\ReadyToInstall\ModifiedFiles" />

  <widget class="\XLite\View\Upgrade\Step\ReadyToInstall\EntriesList" />

  <widget class="\XLite\View\Upgrade\Step\ReadyToInstall\CreateBackup" />

  <div class="ready-to-install-actions">
    <list name="sections" type="inherited" />
    <div class="clear"></div>
  </div>

</form>
