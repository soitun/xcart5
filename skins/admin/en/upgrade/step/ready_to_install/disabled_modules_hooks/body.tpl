{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * List of incompatible entries
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="modified-files-section disabled-modules-hooks-section">
  <div class="modified-files-section-frame disabled-modules-hooks-section-frame">

    <div class="disabled-modules-hooks-message">
      <div class="head">{t(#Disabled modules hooks message head#):h}</div>
      <div class="body">{t(#Disabled modules hooks message body#):h}</div>
    </div>

<table class="downloaded-components disabled-modules">
  <tr class="header">
    <th class="module-info-header">{t(#Component#)}</th>
    <th class="disabled-module-action-header">{t(#Action#)}</th>
  </tr>

  <tr class="module-entry" FOREACH="getDisabledModulesHooks(),entry">
    <td class="module-info">
      <span class="name">{entry.getModuleName()}</span>
      <span class="author">({entry.getAuthorName()})</span>
    </td>
    <td class="disabled-module-action">
      <select name="disabledModulesHooks[{entry.getMarketplaceId()}]">
        {if:entry.hasLicenseRestriction()}
        <option value="0">{t(#Uninstall#)}</option>
        {else:}
        <option value="1" selected="selected">{t(#Enable#)}</option>
        <option value="0">{t(#Uninstall#)}</option>
        {end:}
      </select>
    </td>
  </tr>
</table>

  </div>
</div>