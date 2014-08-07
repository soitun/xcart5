{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Page URL cell template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="plain-value">
  <span class="value"><a href="{entity.getFrontURL()}" target="new">{entity.getFrontURL()}</a></span>
  <img IF="column.noWrap" src="images/spacer.gif" class="right-fade" alt="" />
</div>
