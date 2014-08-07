{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Wholesale minimum quantity list: Input
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="wholesale.minquantity", weight="20")
 *}

 <td class="quantity-input">
   <widget
     class="\XLite\View\FormField\Input\Text"
     fieldOnly="true"
     mouseWheelIcon="false"
     fieldId=""
     fieldName="{getNamePostedData(qty.membershipId,#minQuantity#)}"
     value="{qty.quantity}" />
 </td>
