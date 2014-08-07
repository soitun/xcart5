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
<head>
<title>{config.Company.company_name}: {t(#Invoice#)}</title>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<link href="skins/admin/en/css/style.css" rel="stylesheet" type="text/css">
</head>
<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">
{foreach:getOrders(),order}
<div style="page-break-after: always;">
  <widget class="\XLite\View\Invoice" order="{order}" />
</div>
{end:}
</body>
</html>
