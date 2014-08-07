{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product class 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="XLite\View\Form\Product\Modify\ProductClass" name="update_product_class_form" />
<div class="dialog-block product-class clearfix">
  <div class="product-class-text">
    {if:product.getProductClass()}
      {t(#Product class#)}: <span class="dark">{product.productClass.getName()}</span>
    {else:}
      {t(#No product class assigned#)}
    {end:}
    <widget class="\XLite\View\Button\Submit" label="{t(#Change#)}" />
  </div>
  <div class="product-class-select">
    {t(#Product class#)}:
    <widget class="\XLite\View\FormField\Select\ProductClassWithNew" fieldName="productClass" fieldOnly=true value="{product.getProductClass()}" />
    <input type="text" size="30" name="newProductClass" value="" placeholder="{t(#Name, e.g. Apparel#)}" />
    <widget class="\XLite\View\Button\Submit" label="{t(#Save changes#)}" />
  </div>
  <a href="{buildURL(#product_classes#)}">{t(#Manage product classes#)}</a>
  {if:!product.getProductClass()}
    <div class="clearfix"></div>
  <div class="no-product-class">
    <p>{t(#If you have multiple products sharing the same set of attributes, it makes sence to make them to be of the same product type and create the attributes on the product type level.#)}</p>
  </div>
  {end:}
</div>
<widget name="update_product_class_form" end />
