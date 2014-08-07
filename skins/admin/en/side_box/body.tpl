{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Side bar box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="{getContainerClass()}">
  <h2 IF="getHead()">{t(getHead())}</h2>
  <div class="content">
    <ul>
      {foreach:getItems(),item}
        <li class="{getItemClass(item)}"><a href="{item.link}">{item.title}</a></li>
      {end:}
    </ul>
  </div>
</div>
