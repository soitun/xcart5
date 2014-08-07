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
<head><title>{t(#Sign in notification#)}</title></head>
<body>

<p>{t(#Thank you for registering at company#,_ARRAY_(#company#^config.Company.company_name))}!</p>

<p>{t(#Your account email is X.#,_ARRAY_(#email#^profile.getLogin()))}</p>
{if:password|byCheckout}
  <p IF="password">{t(#Your account password is X.#,_ARRAY_(#password#^password))}</p>
  <p IF="byCheckout">{t(#The password is the one you specified during checkout.#)}</p>
{else:}
  <p>{t(#The password is the one you specified.#)}</p>
{end:}

<p>{signature:h}</p>

</body>
</html>
