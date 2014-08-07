{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="order-status-selector{if:isStatusWarning()} status-warning{end:}">
  <select {getAttributesCode():h}>
    <option value="" IF="getParam(#allOption#)">{t(#All Order Statuses#)}</option>
    {foreach:getOptions(),optionValue,optionLabel}
    <option value="{optionValue}"{if:optionValue=getValue()} selected="selected"{end:}{if:isOptionDisabled(optionValue)} disabled="disabled"{end:}>{t(optionLabel)}</option>
    {end:}
  </select>
    <a IF="isStatusWarning()" id="status_warning_{getParam(#orderId#)}" class="icon-warning popup-warning" href="{getURL()}"><img src="images/spacer.gif" width="1" height="1" alt="" /></a>
  <div IF="isStatusWarning()" class="status-warning-content">
    {t(getStatusWarningContent())}
  </div>
</div>
