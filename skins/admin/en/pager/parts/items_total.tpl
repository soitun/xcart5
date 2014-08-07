{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list items total
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="pager.itemsTotal", weight="20")
 *}

<div IF="isItemsPerPageVisible()" class="pager-items-total">
  {t(#Items#)}:
  <span class="begin-record-number">{getBeginRecordNumber()}</span>
  &ndash;
  <span class="end-record-number">{getEndRecordNumber()}</span> {t(#of#)} <span class="records-count">{getItemsTotal()}</span><span IF="isItemsPerPageSelectorVisible()">, <input type="text" value="{getItemsPerPage()}" class="page-length" /> {t(#per page#)} </span>
</div>

<div class="clear"></div>
