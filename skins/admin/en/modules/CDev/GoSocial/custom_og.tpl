{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product element
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="control">
  <widget class="\XLite\Module\CDev\GoSocial\View\FormField\Select\UseCustomOpenGraph" fieldName="{getNamePostedData(#useCustomOG#)}" value="{product.getUseCustomOG()}" fieldOnly="true" />
</div>
<div class="og-textarea">
  <widget
    class="\XLite\View\FormField\Textarea\Simple"
    fieldName="{getNamePostedData(#ogMeta#)}"
    cols="200"
    rows="8"
    value="{product.getOpenGraphMetaTags(false):h}"
    help="{t(#These Open Graph meta tags were generated automatically based on general product information.#)}"
    fieldOnly="true" />
  <div class="clear"></div>
</div>
