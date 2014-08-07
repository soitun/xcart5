{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * 2-level tabber template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="tabs2-tabbed-content-wrapper">
  <div class="tabs2-tabs-container">
    <div class="tabs2-page-tabs">

      <ul>
        <li FOREACH="getTabs(),tabPage" class="tab{if:tabPage.selected}-current{end:}">
          <a IF="!tabPage.selected" href="{tabPage.url:h}">{t(tabPage.title)}</a>
          <div IF="tabPage.selected">{t(tabPage.title)}</div>
          <div IF="tabPage.selected" class="footer"></div>
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
