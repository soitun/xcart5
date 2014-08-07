{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="review.modify.fields", weight="100")
 *}
<li class="input clearfix">
  <div class="table-label">
    <label for="product" class="product">{t(#Product#)}</label>
  </div>

  <div class="star">*</div>
  <div class="wrapper-table-value" IF="{!getRequestTargetProductId()}">
    <widget
      class="\XLite\View\FormField\Select\Model\ProductSelector"
      fieldOnly="true"
      fieldName="product_title"
      placeholder="{t(#Start typing product name or SKU#)}"
      is_model_required="true"
      value="{getProductId()}" />
  </div>

  <input IF="{!getRequestTargetProductId()}" type="hidden" name="product_id" value="{getProductId()}" class="product-id-value" id="product-id" />

  <div class="table-value" IF="{getRequestTargetProductId()}">
    {getRequestTargetProductTitle()}
  </div>
</li>
