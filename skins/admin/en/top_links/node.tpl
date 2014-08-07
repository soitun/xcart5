{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Top links node
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<li class="link-item {getCSSClass()}">
  {if:getBlock()}
  <div class="link-item-block">{getBlock():h}</div>
  {else:}
  <a href="{getLink()}"{if:hasChildren()} class="list"{end:}{if:getBlankPage()} target="_blank"{end:}>
    <i IF={getIconClass()} class="icon {getIconClass()}"></i>
    <span>{t(getTitle()):h}</span>
  </a>
  {end:}
  <div class="children-block" IF="hasChildren()">
    <ul>
    {foreach:getChildren(),child}
    {child.display()}
    {end:}
    <list name="{getListName()}" />
    </ul>
  </div>
</li>
