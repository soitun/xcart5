{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Page selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="pager.admin.model.table.left", weight="100")
 *}

<div class="pagination-wrapper" IF="isPagesListVisible()">
  <ul class="pagination">
    <li FOREACH="getPages(),page" class="{page.classes}">
      <a IF="{page.href}" href="{page.href}" data-pageId="{page.num}">{t(page.text):h}</a>
      <span IF="{!page.href}">{t(page.text):h}</span>
    </li>
  </ul>
</div>
