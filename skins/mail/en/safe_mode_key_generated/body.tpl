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
  <title>{t(#New safe mode access key has been generated#)}</title>
</head>
<body>
  <p>{t(#New access codes were generated.#)}</p>

  <p>{t(#You need these links in case you want to recover your store#,_ARRAY_(#article#^article_url)):h}</p>

  <p>{t(#Hard reset (disables all modules and runs application)#)}:</p>
  <p>{hard_reset_url}</p>

  <p>{t(#Soft reset (disables all modules except ones that were downloaded from marketplace)#)}:</p>
  <p>{soft_reset_url}</p>
</body>
</html>
