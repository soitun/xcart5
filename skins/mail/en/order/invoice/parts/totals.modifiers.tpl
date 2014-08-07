{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice totals : modifiers
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.base.totals", weight="200")
 *}

<li FOREACH="getSurchargeTotals(),sType,surcharge" style="list-style: none;padding: 0px;margin: 0px;color: #5a5a5a;">
  {if:surcharge.count=#1#}
    <div style="display: inline-block;color: #5a5a5a;">
      {surcharge.lastName}:
      <list name="invoice.base.totals.modifier.name" surcharge="{surcharge}" sType="{sType}" order="{order}" />
    </div>
  {else:}
    <div style="display:inline-block;color: #5a5a5a;">
      {surcharge.name}:
      <list name="invoice.base.totals.modifier.name" surcharge="{surcharge}" sType="{sType}" order="{order}" />
    </div>
  {end:}
  <div style="display: inline-block;color: #5a5a5a;">
    {if:surcharge.available}{formatSurcharge(surcharge)}{else:}{t(#n/a#)}{end:}
    <list name="invoice.base.totals.modifier.value" surcharge="{surcharge}" sType="{sType}" order="{order}" />
  </div>
</li>
