{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Search in title
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @listChild (list="products.search.conditions.advanced.options", weight="100")
 *}

<li><label for="by-title">
  <input type="checkbox" name="by_title" id="by-title" value="Y" checked="{getChecked(#by_title#)}" />
  {t(#Title#)}
</label></li>
