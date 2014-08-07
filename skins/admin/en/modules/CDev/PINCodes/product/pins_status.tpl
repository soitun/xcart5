{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Pin codes status box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.pinCodes", weight="300")
 *}

<div class="pin-codes-status">
  {* Do not remove whitespace in value="", it does not display the value of "0" without this whitespace. Or fix it somewhere else :) *}
  <div class="sold">
    <widget class="\XLite\View\FormField\Label" label="{t(#Sold PINs#)}" value="{product.getSoldPinCodesCount()} " />
  </div>
  <div class="remaining">
    <widget 
      IF="{!product.getAutoPinCodes()}" 
      class="\XLite\View\FormField\Label" 
      label="{t(#Remaining PINs#)}" 
      value="{product.getRemainingPinCodesCount()} " 
    />
  </div>
</div>
<div class="clear"></div>
