{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.step.prepare.incompatible_entries.sections.table.columns", weight="300")
 *}

<td class="disable">
  {* :FIXME: see the FlexyCompiler *}
  <input IF="isModuleToDisable(entry)" id="toDisable{entry.getMarketplaceID()}" type="checkbox" name="toDisable[{entry.getMarketplaceID()}]" value="1" disabled="disabled" checked="1" />
  <input IF="isModuleToDisable(entry)" id="toDisable{entry.getMarketplaceID()}" type="hidden" name="toDisable[{entry.getMarketplaceID()}]" value="1" />
  <input IF="!isModuleToDisable(entry)" id="toDisable{entry.getMarketplaceID()}" type="checkbox" name="toDisable[{entry.getMarketplaceID()}]" value="1" />
  <label for="toDisable{entry.getMarketplaceID()}">{t(#Disable#)}</label>
</td>
