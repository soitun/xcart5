{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product element
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="sale_discount_types", weight="20")
 *}

 <ul class="sale-discount sale-discount-percent">
   <li class="discount-type">
     <input
         id="sale-price-percent-off"
         type="radio"
         name="{getNamePostedData(#discountType#)}"
         value="{%\XLite\Model\Product::SALE_DISCOUNT_TYPE_PERCENT%}"
         {if:getParam(#discountType#)=%\XLite\Model\Product::SALE_DISCOUNT_TYPE_PERCENT%}checked="checked"{end:} />
     <label for="sale-price-percent-off">
      {t(#Percent off#)}
     </label>
   </li>
   <li class="sale-price-value">
     <widget
       class="\XLite\View\FormField\Input\Text\Symbol"
       fieldOnly="true"
       mouseWheelIcon="false"
       symbol="%"
       fieldId="sale-price-value-{%\XLite\Model\Product::SALE_DISCOUNT_TYPE_PERCENT%}"
       value="{getPercentOffValue()}" />
   </li>
 </ul>

 <div class="clear"></div>
