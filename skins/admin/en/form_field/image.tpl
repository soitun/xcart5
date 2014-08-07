{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Image field
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:getValue()}
  <div class="image"><img src="{value.getURL()}" alt="" /></div>
{else:}
  <div class="no-image">{t(#No image#)}</div>
{end:}

<widget
  class="\XLite\View\Button\FileSelector"
  label="{getButtonLabel()}"
  object="{getObject()}"
  objectId="{getObjectId()}"
  fileObject="{getFileObject()}"
  fileObjectId="{getFileObjectId()}" />

{if:isRemoveButtonVisible()}
  <input type="checkbox" name="imagesRemove[{getObject}][{getObjectId()}][{getFileObject()}][{getFileObjectId()}]" id="ir_{getObject}_{getObjectId()}_{getFileObject()}_{getFileObjectId()}" value="1" />
  <label for="ir_{getObject}_{getObjectId()}_{getFileObject()}_{getFileObjectId()}">{t(getRemoveButtonLabel())}</label>
{end:}
