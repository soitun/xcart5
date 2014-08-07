{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order summary mini informer (for dashboard)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div IF="getTabs()" class="js-tabs order-stats-informer-tabs" style="{getBlockStyle()}">

  <div class="tabs">
    <ul class="tabs primary">
      <li FOREACH="getTabs(),index,tab" class="{getTabClass(tab)}">
        <span id="link-{tab.id:h}">{t(tab.name)}</span>
      </li>
    </ul>
  </div>

  <div FOREACH="getTabs(),tab" id="{tab.id:h}" class="tab-container" style="{getTabStyle(tab)}">
    <a name="{tab.id:h}"></a>
    {if:tab.template}
      <widget template="{tab.template}" />

    {elseif:tab.widget}
      <widget class="{tab.widget}" />

    {elseif:tab.list}
      <list name="{tab.list}" />

    {else:}
      No content
    {end:}
  </div>

</div>

<div class="clear"></div>

