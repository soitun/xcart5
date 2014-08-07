{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Pin codes enabled checkbox
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.pinCodes", weight="200")
 *}

<div class="pin-codes-auto">
  <widget 
    class="\XLite\Module\CDev\PINCodes\View\FormField\Select\AutoPinCodes" 
    value="{product.getAutoPinCodes()}" 
    fieldName="autoPinCodes" 
    fieldOnly="true" 
  />
  <div class="clear"></div>
  <div IF="!product.getPinCodesEnabled()" class="can-add-after-saving">
    {t(#You will be able to add pin codes after saving changes.#)}
  </div>

</div>
