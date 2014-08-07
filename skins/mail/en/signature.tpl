{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

--<br />
<div>{t(#Thank you for using company services#,_ARRAY_(#company#^config.Company.company_name))}</div>

<br />

<div IF="config.Company.company_phone">{t(#Phone#)}: {config.Company.company_phone}</div>

<div IF="config.Company.company_fax">{t(#Fax#)}: {config.Company.company_fax}</div>

<div IF="config.Company.company_website">{t(#Website#)}: {config.Company.company_website}</div>
