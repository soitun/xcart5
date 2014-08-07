{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attribute
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
{if:getAttributeGroup()}
<li><h3>{getTitle()}</h3>
  <ul>
{end:}
<li FOREACH="getAttrList(),a">
  <div><strong>{a.name}</strong></div>
  <span class="{a.class}">{a.value:nl2br}</span>
</li>
{if:getAttributeGroup()}
  </ul>
</li>
{end:}
