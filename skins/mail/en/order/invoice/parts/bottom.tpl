{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice bottom block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.base", weight="50")
 *}
<table style="border-color: #cadce8;width: 100%;max-width: 700px;">

    <tr IF="order.isPaymentShippingSectionVisible()">
      <td IF="order.isShippingSectionVisible()" style="padding-top: 20px;padding-right: 15px;width: 90%;font-size: 15px;vertical-align: top;">
        <div style="position: relative;min-width: 300px;background: #f9f9f9;height: 330px;border-radius: 6px;padding: 20px;">
        <list name="invoice.bottom.address.shipping" baddress="{order.profile.billing_address}" saddress="{order.profile.shipping_address}" />
        </div>
      </td>
      <td IF="order.isPaymentSectionVisible()" style="padding-top: 20px;padding-right: 0px;width: 50%;font-size: 15px;vertical-align: top;">
        <div style="position: relative;min-width: 300px;background: #f9f9f9;height: 330px;border-radius: 6px;padding: 20px;">
        <list name="invoice.bottom.address.billing" baddress="{order.profile.billing_address}" saddress="{order.profile.shipping_address}" />
        </div>
      </td>
    </tr>

    <tr FOREACH="getViewList(#invoice.bottom#),w">
      {w.display()}
    </tr>

</table>
