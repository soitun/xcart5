{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Currency selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<select name="{field}" class="{className}" onchange="{onchange}" id="{fieldId}">
   <option FOREACH="getCurrencies(),v" value="{v.getCurrencyId():r}" selected="{v.getCurrencyId()=currency}">{v.getName():h}</option>
</select>
