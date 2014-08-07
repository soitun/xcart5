{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice billing address
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.bottom.address.billing", weight="10")
 *}
<strong style="color: #000;font-size: 20px;font-weight: normal;padding-bottom: 3px;">{t(#Billing address#)}</strong>
<ul style="padding-top: 12px;list-style: none;margin: 0;padding-left: 0;">
  <li FOREACH="getAddressSectionData(baddress),idx,field" style="padding-right: 4px;white-space: nowrap;" class="{field.css_class} address-field">
    <span style="font-size: 14px;line-height: 20px;padding-top: 8px;color: #333;font-style: italic;">{t(field.title)}:</span>
    <span style="font-size: 14px;line-height: 20px;padding-top: 8px;color: #000;">{field.value}</span>
  </li>
</ul>
<p style="line-height: 18px;padding-top: 0px;margin: 0px;font-size: 14px;">
  <span style="color: #333;font-style: italic;">{t(#E-mail#)}</span>:
  <a style="font-size: 14px;color: #000;" href="mailto:{order.profile.login}">{order.profile.login}</a>
</p>
