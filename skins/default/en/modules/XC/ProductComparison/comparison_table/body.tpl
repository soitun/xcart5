{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Body
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div id="compare">
  <table class="comparison-table">
    <tbody class="header">
      <list name="comparison_table.header" />
    </tbody>
    <tbody class="header-hidden">
      <tr>
        <td style="{getStyle()}">&nbsp;</td>
        <td FOREACH="getProducts(),product" style="{getStyle()}">&nbsp;</td>
      </tr>
    </tbody>
    <tbody class="header-fixed">
    <list name="comparison_table.header_fixed" />
    </tbody>
    <tbody class="data">
    <list name="comparison_table.data" />
    </tbody>
  </table>
</div>
