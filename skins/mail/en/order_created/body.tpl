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
{t(#Dear X#,_ARRAY_(#firstname#^order.profile.billing_address.firstname,#lastname#^order.profile.billing_address.lastname)):h}
<p>
{t(#Thank you for your order FOOTER#):h}
<p>
<widget class="\XLite\View\Invoice" order="{order}" />
<p>
{signature:h}
</body>
</html>
