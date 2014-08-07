{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Body
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="filter type-c clearfix{if:getValue()} checked{end:}">
  <widget 
    class="XLite\View\FormField\Input\Checkbox\Enabled"
    fieldName="filter[inStock]"
    useColon=false
    label="In stock only"
    value="{getValue()}" />
</div>
