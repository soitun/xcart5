{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.search.conditions.by-keywords", weight="20")
 *}

<li>
  <input type="checkbox" name="by_sku" id="by-sku" value="Y" checked="{getCondition(#by_sku#)}" />
  <label for="by-sku">{t(#SKU#)}</label>
</li>
