{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Country selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<select name="{field}" onchange="{onchange}" id="{fieldId}">
   <option IF="hasSelectOne()" value="">{t(#Select one#)}</option>
   <option FOREACH="getCountries(),v" value="{v.code:r}" selected="{v.code=country}">{v.country:h}</option>
</select>
