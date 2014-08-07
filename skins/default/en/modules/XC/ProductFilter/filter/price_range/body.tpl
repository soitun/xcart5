{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Body
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="filter price-range">
  <widget 
    class="XLite\Module\XC\ProductFilter\View\FormField\ValueRange\ValueRange"
    fieldName="filter[price]"
    useColon=false
    label="Price range"
    value="{getValue()}"
    isOpened="true"
    minValue="{getMinPrice()}"
    maxValue="{getMaxPrice()}"
    unit="{getSymbol()}" />
</div>
