{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attribute list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:getAttributeGroup()}
<tr class="group">
  <td class="title"><span>{getTitle()}</span></td>
  <td FOREACH="getProducts(),product">&nbsp;</td>
<tr>
{end:}

<tr FOREACH="getAttributesList(),a">
  <td{if:getAttributeGroup()} class="indented"{end:}><span>{a.getName()}</span></td>
  <td FOREACH="getProducts(),product">{getAttributeValue(a,product):h}</td>
</tr>
