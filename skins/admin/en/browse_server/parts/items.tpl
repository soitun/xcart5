{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Browser server dialog : items
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="browseServer", zone="admin", weight="100")
 *}
<div class="browse-selector">
  <ul class="file-system-entries">
    <li class="file-system-entry up-level">
      {displayCommentedData(getCatalogInfo())}
      <a class="type-catalog up-level"><img src="images/spacer.gif" alt="" />[...]</a>
    </li>
    <li FOREACH="getFSEntries(),idx,entry" class="fs-entry">
      <list name="browseServer.item" entry="{entry}" />
    </li>
    <li IF="isEmptyCatalog()" class="empty-catalog">{t(#Directory is empty#)}</li>
  </ul>
</div>


