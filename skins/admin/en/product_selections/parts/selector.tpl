{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="selector">
  <div IF="isExcludedProductId(entity.getUniqueIdentifier())" class="title" title="{getTitleExcludedProduct(entity.getUniqueIdentifier())}">
    <i class="fa {getStyleExcludedProduct(entity.getUniqueIdentifier())}"></i>
  </div>
  <input
    IF="!isExcludedProductId(entity.getUniqueIdentifier())"
    type="checkbox"
    name="{getSelectorDataPrefix()}[{entity.getUniqueIdentifier()}]"
    value="1"
    class="selector not-significant" />
</div>
