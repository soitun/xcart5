{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Table model list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<a name="{getAnchorName()}" class="list-anchor"></a>
<div {getContainerAttributesAsString():h}>
  {displayCommentedData(getItemsListParams())}
  <div IF="isHeaderVisible()" class="list-header">
    <div FOREACH="getTopActions(),tpl" class="button-container"><widget template="{tpl:h}" /></div>
    <list name="header" type="inherited" />
  </div>

  <widget IF="isPageBodyVisible()" template="{getPageBodyTemplate()}" />
  <div IF="!isPageBodyVisible()" class="no-items">
    <widget template="{getEmptyListTemplate()}" />
  </div>
  <div IF="isPagerVisible()" class="table-pager">{pager.display()}</div>

  <div IF="isFooterVisible()" class="list-footer">
    <div FOREACH="getBottomActions(),tpl" class="button-container"><widget template="{tpl:h}" /></div>
    <list name="footer" type="inherited" />
  </div>

</div>

<widget IF="isPanelVisible()" class="{getPanelClass()}" />
