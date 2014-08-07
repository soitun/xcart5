{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product element
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<input type="hidden" name="{getNamePostedData(#participateSale#)}" value="0" />

<label class="participate-sale" for="participate-sale">
<input
  type="checkbox"
  id="participate-sale"
  name="{getNamePostedData(#participateSale#)}"
  value="1"
  {if:product.getParticipateSale()}checked="checked"{end:} />{t(#Product on sale#)}</label>

<div class="sale-discount-types">
  <widget
    class="\XLite\Module\CDev\Sale\View\SaleDiscountTypes"
    salePriceValue="{product.getSalePriceValue()}"
    discountType="{product.getDiscountType()}" />
</div>
