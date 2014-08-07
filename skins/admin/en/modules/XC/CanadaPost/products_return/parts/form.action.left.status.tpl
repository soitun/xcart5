{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Canada Post products return :: from :: actions :: left :: status change
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="capost_return.form.actions.left", weight="100")
 *}

<div class="status">
  <widget 
    class="\XLite\Module\XC\CanadaPost\View\FormField\Select\ReturnStatus"
    label="Status"
    fieldName="postedData[status]"
    value="{productsReturn.getStatus()}" />
</div>
