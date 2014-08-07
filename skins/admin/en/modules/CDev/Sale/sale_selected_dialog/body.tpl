{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Set the sale price dialog. Products list popup dialog.
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="\XLite\Module\CDev\Sale\View\Form\SaleSelectedDialog" name="sale_selected_dialog_form" />

 <div class="set-price-dialog">

   <widget
     class="\XLite\Module\CDev\Sale\View\SaleDiscountTypes"
     salePriceValue="0"
     discountType="{%\XLite\Model\Product::SALE_DISCOUNT_TYPE_PRICE%}" />

   <div class="sale-label">{t(#The changes will be applied to all selected products#)}</div>

   <widget class="\XLite\View\Button\Submit" style="action" label="Apply price" />

 </div>

<widget name="sale_selected_dialog_form" end />
