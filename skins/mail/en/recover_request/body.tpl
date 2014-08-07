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

<p>{t(#You are receiving this e-mail message because you have requested to recover your forgotten password.<br>
If you did not submit such a request, it might mean that somebody was trying to gain access to your account at#):h} {config.Company.company_name}.

<p>{t(#To confirm that this request was submitted by you, click on the link below#)}:<br>
<a href="{url}">{url:h}</a>

<p>{t(#Alternatively, you can copy and paste the link URL into the 'Location' field of your browser.<br>
Once you confirm the request, you will be signed in and asked to create a new password.#):h}

<br>

<p>{signature:h}
</body>
</html>
