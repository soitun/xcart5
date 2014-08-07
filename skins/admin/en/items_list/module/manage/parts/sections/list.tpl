{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.module.manage.sections", weight="400")
 *}

<widget class="\XLite\View\Form\Module\Manage" name="modules_manage_form" />
  <table cellspacing="0" cellpadding="0" class="data-table items-list modules-list">
    {foreach:getPageData(),idx,module}
    <tr class="module-item module-{module.getModuleId()} module-{module.getName()}{if:!module.getEnabled()} disabled{end:}">
    <list name="columns" type="inherited" module="{module}" />
    </tr>
    {end:}
  </table>
  <div class="pager-bottom {pager.getCSSClasses()}">{pager.display()}</div>
  <widget class="XLite\View\StickyPanel\ItemsListForm" />
<widget name="modules_manage_form" end />
