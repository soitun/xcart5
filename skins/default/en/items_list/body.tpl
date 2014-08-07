{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="{getListCSSClasses()}">
  {displayCommentedData(getJSData()):s}

  <h2 IF="isHeadVisible()" class="items-list-title {getListHeadClass()}">{getListHead()}</h2>
  <div IF="isPagerVisible()" class="list-pager">{pager.display():s}</div>
  <div IF="isHeaderVisible()" class="list-header"><list name="header" type="inherited" /></div>

  <widget template="{getPageBodyTemplate()}" />

  <div class="list-pager list-pager-bottom" IF="isPagerVisible()&pager.isPagesListVisible()">{pager.display():s}</div>
  <div IF="isFooterVisible()" class="list-footer"><list name="footer" type="inherited" /></div>

  <widget IF="isEmptyListTemplateVisible()" template="{getEmptyListTemplate()}" />
</div>
