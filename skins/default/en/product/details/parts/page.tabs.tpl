{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product details information block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.details.page", weight="40")
 *}

<div IF="getTabs()" class="product-details-tabs">

  <div class="tabs">
    <ul class="tabs primary">
      <li FOREACH="getTabs(),index,tab" class="{getTabClass(tab)}">
        <a data-id="{tab.id:h}" href="#{tab.id:h}">{t(tab.name)}</a>
      </li>
    </ul>
  </div>

  <div class="tabs-container">
  <div FOREACH="getTabs(),tab" id="{tab.id:h}" class="tab-container" style="{getTabStyle(tab)}">
    <a name="{tab.id:h}"></a>
    {if:tab.template}
      <widget template="{tab.template}" />

    {else:}
      {if:tab.widget}
        <widget class="{tab.widget}" product="{product}" />

      {else:}
        {if:tab.list}
          <list name="{tab.list}" product="{product}" />
        {else:}
          {if:tab.widgetObject}
            {tab.widgetObject.display():h}
          {end:}
        {end:}
      {end:}
    {end:}
  </div>
  </div>

</div>
