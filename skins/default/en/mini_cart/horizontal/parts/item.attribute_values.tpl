{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Minicart row with item attribute-values
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<a class="item-attribute-values underline-emulation" href="{buildURL(#cart#)}" id="item-attribute{item.getItemId()}" rel="div.item-attribute-values.item-{item.getItemId()}"><span>{t(#attributes#)}</span></a>
<br />
<div class="internal-popup item-attribute-values item-{item.getItemId()}" style="display: none;">
  <ul class="item-attribute-values">
    <li FOREACH="item.getSortedAttributeValues(),av">{av.getActualName()}: {av.getActualValue()}</li>
  </ul>
</div>
