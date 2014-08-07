{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attributes 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget IF="{getProductClasses()}" class="XLite\Module\XC\ProductComparison\View\ComparisonTable\AttributeList" classes="{getProductClasses()}" />
<widget class="XLite\Module\XC\ProductComparison\View\ComparisonTable\AttributeList" />
{foreach:getProductClasses(),productClass}
  {foreach:productClass.getAttributeGroups(),group}
    <widget class="XLite\Module\XC\ProductComparison\View\ComparisonTable\AttributeList" group="{group}" />
  {end:}
{end:}
{foreach:getGlobalGroups(),group}
  <widget class="XLite\Module\XC\ProductComparison\View\ComparisonTable\AttributeList" group="{group}" />
{end:}
