{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Tabber template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<h1 IF="isWrapperVisible()">{t(getMainTitle())}</h1>

<div class="tabbed-content-wrapper" IF="isWrapperVisible()">
  <div class="tabs-container">
    <div class="page-tabs">

      <ul>
        <li FOREACH="getTabs(),tabPage" class="tab{if:tabPage.selected}-current active{end:}">
          <a href="{tabPage.url:h}">{t(tabPage.title)}</a>
        </li>
      </ul>

    </div>
    <div class="clear"></div>

    <div class="tab-content">
      <widget template="{getTabTemplate()}" IF="isTemplateOnlyTab()" />
      <widget widget="{getTabWidget()}" IF="isWidgetOnlyTab()" />
      <widget widget="{getTabWidget()}" template="{getTabTemplate()}" IF="isFullWidgetTab()" />
      <widget template="{getPageTemplate()}" IF="isCommonTab()" />
    </div>

  </div>
</div>

<div IF="!isWrapperVisible()">
  <widget template="{getTabTemplate()}" IF="isTemplateOnlyTab()" />
  <widget widget="{getTabWidget()}" IF="isWidgetOnlyTab()" />
  <widget widget="{getTabWidget()}" template="{getTabTemplate()}" IF="isFullWidgetTab()" />
  <widget template="{getPageTemplate()}" IF="isCommonTab()" />
</div>
