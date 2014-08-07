{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Select date
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<select id='{getField()}Month' name="{getField()}Month" IF="!hide_months" style="width: 120px;">
	<option FOREACH="getMonths(),k,v" value="{k}" selected="{v=#selected#}">{getMonthString(k)}</option>
</select>

<select id='{getField()}Day' name="{getField()}Day" IF="!hide_days" style="width: 120px;">
	<option FOREACH="getDays(),k,v" value="{k}" selected="{v=#selected#}">{k}</option>
</select>

<select id='{getField()}Year' name="{getField()}Year" IF="!hide_years" style="width: 80px;">
	<option FOREACH="getYears(),k,v" value="{k}" selected="{v=#selected#}">{k}</option>
</select>
