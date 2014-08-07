{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Common field output
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="plain-value">
  <span IF="isLink(column,entity)" class="value">
    <a
      href="{buildEntityURL(entity,column)}"
      {if:column.noWrap} title="{getColumnValue(column,entity)}"{end:}
      class="link">{getColumnValue(column,entity)}
    </a>
  </span>
  <span IF="!isLink(column,entity)" class="value">{getColumnValue(column,entity):h}</span>
  <img IF="column.noWrap" src="images/spacer.gif" class="right-fade" alt="" />
</div>
