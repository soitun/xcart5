{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Export begin section : sections
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="export.begin.content", weight="100")
 *}

<div class="parts">
  <h3>{t(#What to export#)}</h3>
  <ul class="clearfix sections">
    <li FOREACH="getSections(),i,section">
      <input type="checkbox" name="section[]" value="{i}" id="section{formatClassNameToString(i)}"{if:isSectionSelected(i)}checked="checked"{end:}{if:isSectionDisabled(i)} disabled="disabled"{end:} />
      <label for="section{formatClassNameToString(i)}"{if:isSectionDisabled(i)} class="disabled"{end:}>{t(section)}</label>
    </li>
  </ul>
</div>
