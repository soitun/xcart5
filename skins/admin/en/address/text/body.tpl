{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<ul class="address-entry">

{foreach:getSchemaFields(),fieldName,fieldData}

<li class="address-text-{fieldName}" IF="{getFieldValue(fieldName)}">

  <div class="clear"></div>

  <ul class="address-text">

    <li class="address-text-label-{fieldName}">
      {fieldData.label}:
    </li>

    <li class="address-text-value">
      {getFieldValue(fieldName,1)}
    </li>

    <li class="address-text-comma-{fieldName}" IF="{getFieldValue(fieldName, 1)}">,</li>

  </ul>

  <div class="clear"></div>

</li>

{end:}

</ul>
