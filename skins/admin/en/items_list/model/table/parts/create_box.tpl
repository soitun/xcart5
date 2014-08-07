{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Create box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<tr class="create-tpl" style="display: none;">
  <td FOREACH="getCreateColumns(),column" class="{getColumnClass(column,dumpEntity)}">
    {if:column.createClass}
      <widget class="{column.createClass}" idx="{idx}" entity="{getDumpEntity()}" column="{column}" itemsList="{getSelf()}" fieldName="{column.code}" fieldParams="{column.params}" editOnly="true" />
    {else:}
      <widget template="{column.template}" idx="{idx}" entity="{getDumpEntity()}" column="{column}" editOnly="true" />
    {end:}
  </td>
</tr>
