{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * List of incompatible entries
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="premium-license-modules-section">
<div class="incompatible-module-list-description premium-license-modules-message">
  {t(#Premium license modules warning#,_ARRAY_(#purchaseURL#^getPurchaseURL(),#installedModulesURL#^buildURL(#addons_list_installed#))):h}
</div>

<table class="incompatible-modules-list premium-license-modules-list">
  <tr FOREACH="getModules(),entry">
    <td class="module-info">
      <span class="name">{entry.getName()}</span>
      <span class="author">({t(#by#)} {entry.getAuthor()})</span>
    </td>
  </tr>
</table>
</div>