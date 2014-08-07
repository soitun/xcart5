{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Create return :: form :: products :: column :: return amount
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="capost_create_return.form.columns", weight="30")
 *}

<div class="return-amount">
  <widget 
    class="\XLite\View\FormField\Input\Text\Integer" 
    className="amount" 
    fieldOnly="true" 
    fieldName="items[{item.getItemId()}][amount]" 
    min="0" 
    max="{item.getAmount()}" />
</div>
