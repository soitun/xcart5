{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product element
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="sale_discount_types", weight="40")
 *}

 <input IF="getParam(#discountType#)=%\XLite\Model\Product::SALE_DISCOUNT_TYPE_PERCENT%"
   type="hidden"
   id="sale-price-value"
   name="{getNamePostedData(#salePriceValue#)}"
   value="{getPercentOffValue()}" />
