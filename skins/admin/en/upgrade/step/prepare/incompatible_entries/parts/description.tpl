{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Info message
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.step.prepare.incompatible_entries.sections", weight="100")
 *}

<div class="incompatible-module-list-description">
  {t(#These modules may be incompatible with the upcoming upgrade. No guarantee that the store will operate correctly if the modules remain enabled. Please consider disabling the modules before proceeding to the next step#)}.
</div>
<div IF="hasDisabledEntries()" class="incompatible-module-list-description">
  {t(#Please note that some of these modules are definitely incompatible with the upcoming upgrade and will be disabled in order to prevent the system crash#)}.
</div>
