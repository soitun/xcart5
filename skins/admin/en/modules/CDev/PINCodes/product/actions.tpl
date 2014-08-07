{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Pin codes actions box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.pinCodes", weight="400")
 *}

{if:!product.getAutoPinCodes()}
  <div class="pin-codes-actions">
    {if:product.getPinCodesEnabled()}
      <widget class="\XLite\Module\CDev\PINCodes\View\AddPinCodesButton" />
      <widget
        class="\XLite\View\Button\FileSelector"
        label="Import from CSV file"
        object="import_pin_codes"
        objectId="{product.getId()}"
        fileObject="" />
    {end:}
  </div>
  <div class="clear"></div>
{end:}
