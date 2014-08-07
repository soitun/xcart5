{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Pin codes enabled checkbox
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.pinCodes", weight="100")
 *}

<div class="pin-codes-enabled">
   <widget class="\XLite\Module\CDev\PINCodes\View\FormField\Input\Checkbox\Highlighted" fieldOnly="true" value="{product.getPinCodesEnabled()}" fieldName="pins_enabled" fieldId="enabled-checkbox" />
  <label for="enabled-checkbox">{t(#PIN codes enabled#)}</label>
</div>
<div class="clear"></div>
