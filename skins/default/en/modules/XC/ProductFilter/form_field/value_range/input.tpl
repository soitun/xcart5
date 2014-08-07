{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Value range
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="value-range" IF="{!displayLabelOnly()}">
  <span class="unit" IF="{getUnit()}">{getUnit()}</span>
  <input type="text" value="{getRangeValue(0)}" name="{getName()}[0]" class="min-value form-control" placeholder="{getMinValue()}" /> 
  <span class="dash">&mdash;</span> 
  <input type="text" value="{getRangeValue(1)}" name="{getName()}[1]" class="max-value form-control" placeholder="{getMaxValue()}" />
</div>
