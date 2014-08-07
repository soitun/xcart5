{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<html>
<head><title>{t(#Register user#)}</title></head>
<body>

<p>{t(#Dear X#,_ARRAY_(#firstname#^profile.billing_address.firstname,#lastname#^profile.billing_address.lastname))}!</p>

<p>{t(#Thank you for shopping at X! We noticed that one or more orders you made at our store were placed using guest checkout#,_ARRAY_(#company#^config.Company.company_name))}</p>
<p>{t(#To log in to your account, please use the following credentials#,_ARRAY_(#login#^profile.login,#password#^password)):h}</p>
<p>{t(#The password can be changed in your account profile#)}</p>

<p>{signature:h}</p>

</body>
</html>
