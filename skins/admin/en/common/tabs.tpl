{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Tabber template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<h1>{t(getTitle())}</h1>

<div class="tabbed-content-wrapper">
  <div class="tabs-container">
    <div class="page-tabs clearfix" IF="isTabsNavigationVisible()">

      <ul>
        <li FOREACH="getTabs(),tabPage" class="tab{if:tabPage.selected}-current{end:}">
          <a href="{tabPage.url:h}">{t(tabPage.title)}</a>
        </li>
        <list name="tabs.items">
      </ul>
    </div>
    <div class="clear"></div>

    <div class="tab-content">
      <widget template="{getTabTemplate()}" IF="isTemplateOnlyTab()" />
      <widget class="{getTabWidget()}" IF="isWidgetOnlyTab()" />
      <widget class="{getTabWidget()}" template="{getTabTemplate()}" IF="isFullWidgetTab()" />
      <widget template="{getPageTemplate()}" IF="isCommonTab()" />
    </div>

  </div>
</div>
