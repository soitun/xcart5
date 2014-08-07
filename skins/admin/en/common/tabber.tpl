{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Tabber template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<h1 IF="head">{t(head)}</h1>

<div class="tabbed-content-wrapper" IF="getTabberPages()">
  <div class="tabs-container">
    <div class="page-tabs clearfix">

      <ul>
        <li FOREACH="getTabberPages(),tabPage" class="tab{if:tabPage.selected}-current{end:}">
          <a href="{tabPage.url}">{t(tabPage.title)}</a>
        </li>
      </ul>

      <div class="list-after-tabs">
        <list name="page.tabs.after" />
      </div>

    </div>
    <div class="clear"></div>

    <div class="tab-content">
      <widget template="{getParam(#body#)}" />
    </div>

  </div>
</div>
