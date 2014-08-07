{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Address 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<ul class="address-entry">

  {foreach:getSchemaFields(),fieldName,fieldData}

    <li class="{getFieldStyle(fieldName)}" IF="{getFieldValue(fieldName)}">

      <ul class="address-text">
        <li class="address-text-label address-text-label-{fieldName}">{fieldData.label}:</li>
        <li class="address-text-value">{getFieldValue(fieldName,1)}</li>
        <li class="address-text-comma address-text-comma-{fieldName}">,</li>
      </ul>

    </li>

  {end:}

</ul>

<div class="clear"></div>
