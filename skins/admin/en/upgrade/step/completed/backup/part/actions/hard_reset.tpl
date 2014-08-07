{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Hard reset
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.step.completed.backup.actions", weight="200")
 * @ListChild (list="upgrade.step.ready_to_install.create_backup.actions", weight="200")
 *}

<div class="upgrade-note hard-reset">
  <span class="hard-reset-label">{t(#Disables absolutely all modules (hard reset)#):h}:</span>
  <div class="hard-reset-link-block safe-mode-link">{getHardResetURL()}</div>
</div>
