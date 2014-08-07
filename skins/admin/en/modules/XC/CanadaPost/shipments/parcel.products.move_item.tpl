{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Parcel items list part: move item
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="move-parcel-item">
  <input type="text" name="moveItems[{entity.getId()}][amount]" size="3" maxlength="12" value="" />
  <select name="moveItems[{entity.getId()}][parcelId]">
    <option value=""></option>
    <option FOREACH="getAllowedToMoveParcels(entity.parcel),k,v" value="{k}">{v}</option>
  </select>
</div>
