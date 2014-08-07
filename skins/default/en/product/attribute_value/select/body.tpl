{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attribute value (Select)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<span class="title">{attribute.name}</span>
<select class="form-control" name="{getName()}" data-attribute-id="{attribute.id}">
  <option FOREACH="getAttrValue(),v" selected="{isSelectedValue(v)}" value="{v.id}">{getOptionTitle(v)}{getModifierTitle(v):h}</option>
</select>
