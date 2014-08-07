{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="install-addon.buttons")
 *}

<widget
  IF="isUpgradeEntryAvailable()"
  class="\XLite\View\Button\Addon\SelectInstallationType"
  moduleId="{getModuleId()}"
  label="{t(#Install add-on#)}"
  style="submit-button main-button"
  disabled=true />
