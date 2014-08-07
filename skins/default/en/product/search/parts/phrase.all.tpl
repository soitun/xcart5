{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Search phrase : all
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @listChild (list="products.search.conditions.phrase", weight="100")
 *}

<li>
  <input type="radio" name="including" id="including-all" value="all" checked="{getChecked(#including#,#all#)}" />
  <label for="including-all">{t(#All words#)}<label/>
</li>
