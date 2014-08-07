{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<span class="address-text">

  <table width="100%" cellpadding="3" cellspacing="0">

    <tr>
      <td></td>
      <td colspan="2"></td>
    </tr>

    <tr FOREACH="getSchemaFields(),fieldName,fieldData">
      <widget
        class="{fieldData.class}"
        label="{fieldData.label}"
        fieldName="{fieldName}"
        value="{getFieldValue(fieldName)}"
        required="{fieldData.required}" />
    </tr>

  </table>

</span>
