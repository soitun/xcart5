{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order status info
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<span IF="getLabel()" class="order-status-label">{getLabel()}:</span>
{if:getParam(#useWrapper#)}
<list name="order_status.wrapper" />
{end:}
{if:!getParam(#useWrapper#)}
<list name="order_status.nowrapper" />
{end:}
