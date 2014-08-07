{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products return reject message body
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<html>
<body>
{t(#Dear X#,_ARRAY_(#firstname#^productsReturn.order.profile.billing_address.getFirstname(),#lastname#^productsReturn.order.profile.billing_address.getLastname())):h}
<p>
{t(#Products return has been rejected#,_ARRAY_(#return_number#^productsReturn.getNumber()))}!
<p>
{t(#Administrator notes#)}:<br>
{notes:h}
<p>
{signature:h}
</body>
</html>
