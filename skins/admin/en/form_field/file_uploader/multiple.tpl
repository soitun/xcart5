{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * File upload template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div{getDataCode():h} class="multiple-files">
{foreach:getValue(),object}
  <widget class="XLite\View\FileUploader" object="{object}" maxWidth="{getMaxWidth()}" maxHeight="{getMaxHeight()}" isImage="{isImage()}" fieldName="{getName()}" multiple="true" />
{end:}
  <widget class="XLite\View\FileUploader" maxWidth="{getMaxWidth()}" maxHeight="{getMaxHeight()}" isImage="{isImage()}" fieldName="{getName()}" multiple="true" />
</div>
