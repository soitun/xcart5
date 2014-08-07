{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Search in SKU
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @listChild (list="products.search.conditions.advanced.options", weight="300")
 *}

<li><label for="by-sku">
  <input type="checkbox" name="by_sku" id="by-sku" value="Y" checked="{getChecked(#by_sku#)}" />
  {t(#SKU#)}
</label></li>
