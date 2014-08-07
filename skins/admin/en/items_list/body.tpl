{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div IF="hasResults()" class="widget items-list widgetclass-{getWidgetClass()} widgettarget-{getWidgetTarget()} sessioncell-{getSessionCell()}">

  {displayCommentedData(getItemsListParams())}

  <div IF="pager.isVisible()" class="table-pager pager-top {pager.getCSSClasses()}">{pager.display()}</div>

  <div IF="isHeaderVisible()" class="list-header"><list name="header" type="inherited" /></div>

  <widget template="{getPageBodyTemplate()}" />

  <div IF="pager.isVisibleBottom()" class="table-pager pager-bottom {pager.getCSSClasses()}">{pager.display()}</div>

  <div IF="isFooterVisible()" class="list-footer"><list name="footer" type="inherited" /></div>

</div>

<widget IF="isEmptyListTemplateVisible()" template="{getEmptyListTemplate()}" />
