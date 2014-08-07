{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Invoice : header : address box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.head", weight="10")
 *}
<td style="width: 99%;white-space: nowrap;">
  <strong>{config.Company.company_name}</strong>
  <p>
    {if:config.Company.location_address}{config.Company.location_address}<br />{end:}
    {if:config.Company.location_city}{config.Company.location_city}, {end:}{if:config.Company.locationState.state}{config.Company.locationState.state}, {end:}{if:config.Company.location_zipcode}{config.Company.location_zipcode}{end:}<br />
    {if:config.Company.locationCountry}{config.Company.locationCountry.getCountry()}{end:}
  </p>
  <p IF="config.Company.company_phone|config.Company.company_fax">
    {if:config.Company.company_phone}{t(#Phone#)}: {config.Company.company_phone}<br />{end:}
    {if:config.Company.company_fax}{t(#Fax#)}: {config.Company.company_fax}{end:}
  </p>
  <p IF="config.Company.company_website" class="url">
    <a href="{config.Company.company_website}">{config.Company.company_website}</a>
  </p>
</td>
