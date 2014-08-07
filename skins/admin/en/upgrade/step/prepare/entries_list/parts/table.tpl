{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Entries list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.step.prepare.entries_list.sections", weight="100")
 *}

<table class="entries-list">
  <tr class="header"><list name="sections.table.header" type="inherited" /></tr>
  <tr class="separator"><td colspan="6"></td></tr>
  {foreach:getUpgradeEntries(),entry}
  <tr class="{getEntryRowCSSClass(entry)}">
    <list name="sections.table.columns" type="inherited" entry="{entry}" />
    {if:!isModule(entry)}
      </tr><tr class="separator"><td colspan="6"></td>
    {end:}
  </tr>
  {end:}
</table>
