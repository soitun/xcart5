{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Pager
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<ul class="pagination grid-list" IF="isPagesListVisible()">
  <li FOREACH="getPages(),page" class="{page.classes}">
    <a IF="page.href" href="{page.href}" class="{page.page}" title="{t(page.title)}">{t(page.text)}</a>
    <span IF="!page.href" class="{page.page}" title="{t(page.title)}">{t(page.text)}</span>
  </li>
</ul>

<list name="itemsTotal" type="inherited" />
