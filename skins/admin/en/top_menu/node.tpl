{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Top menu node
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<li class="menu-item {getCSSClass()}">
  <a href="{getLink()}">{t(getTitle()):h}</a>
  <div IF="hasChildren()">
    <ul>
      {foreach:getChildren(),child}
        {child.display()}
      {end:}
      <list name="{getListName()}" />
    </ul>
  </div>
</li>
