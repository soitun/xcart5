{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Date selector template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<select name="{getField()}Month">
  <option FOREACH="getMonths(),k,v" value="{k}" selected="{v}">{getMonthString(k)}</option>
</select>

<select name="{getField()}Day">
  <option FOREACH="getDays(),k,v" value="{k}" selected="{v}">{k}</option>
</select>

<select name="{getField()}Year">
  <option FOREACH="getYears(),k,v" value="{k}" selected="{v}">{k}</option>
</select>
