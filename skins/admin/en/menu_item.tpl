{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Menu item
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<a href="{buildURL(item.target)}" class="icon"><img src="{layout.getResourceWebPath(item.icon)}" alt="{t(item.title)}" /></a>
<a href="{buildURL(item.target)}" class="title">{t(item.title)}</a>
<span IF="item.description">{t(item.description)}</span>
