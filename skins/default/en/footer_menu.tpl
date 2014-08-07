{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Top menu
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div id="secondary-menu" class="clearfix">
{foreach:getItems(),i,item}
  <span {displayItemClass(i,item):h}><a href="{item.url}" {if:item.active}class="active"{end:}>{item.label}</a></span>
{end:}
</div>
