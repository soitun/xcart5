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
<body>
<p>{config.Company.company_name}: {t(#Automated help-desk system#)}

<p>{t(#You can now use the following credentials to access your account#)}:

<p>{t(#E-mail#)}: {email:h}<br>
{t(#Your new password#)}: {new_password:h}

<p>{t(#To change the password, log into your company account and use the 'Modify profile' link#,_ARRAY_(#company#^config.Company.company_name))}.

<br>

<p>{signature:h}
</body>
</html>
