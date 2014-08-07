{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Module status icon
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.step.prepare.incompatible_entries.sections.table.columns", weight="200")
 *}

<td IF="isModuleToDisable(entry)" class="module-status status-incompatible"></td>
<td IF="!isModuleToDisable(entry)" class="module-status"></td>
