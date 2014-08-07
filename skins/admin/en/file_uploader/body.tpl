{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * File upload template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="{getDivStyle()}" data-object-id="{getObjectId()}">
  <input type="checkbox" name="{getName()}[delete]" value="1" class="input-delete" />
  <input IF="isMultiple()" type="hidden" name="{getName()}[position]" value="{getPosition()}" class="input-position" />
  <input IF="isTemporary()" type="hidden" name="{getName()}[temp_id]" value="{object.id}" class="input-temp-id" />
  <a href="{getLink()}" class="link" data-toggle="dropdown">
    {getPreview():h}
    <div class="icon">
      <i class="{getIconStyle()}"></i>
    </div>
  </a>
  <ul class="dropdown-menu" role="menu">
    <list name="file-uploader.menu" />
  </ul>
</div>
