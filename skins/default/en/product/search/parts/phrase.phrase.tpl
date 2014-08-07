{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Search phrase : pharse
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @listChild (list="products.search.conditions.phrase", weight="300")
 *}

<li>
  <input type="radio" name="including" id="including-phrase" value="phrase" checked="{getChecked(#including#,#phrase#)}" />
  <label for="including-phrase">{t(#Exact phrase#)}</label>
</li>
