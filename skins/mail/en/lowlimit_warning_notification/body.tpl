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
<p>{t(#Warning message from#)} {config.Company.company_name}

<p>
{t(#Product ID#)}# {product.product_id}<br>
{t(#SKU#)}: {product.sku:h}<br>
{t(#Product name#)}: {product.name:h}<br>
<widget module="CDev\ProductOptions" template="modules/CDev/ProductOptions/selected_options.tpl" IF="product.productOptions"/>
<br>
{amount} {t(#item(s) in stock#)}<br>
<br>

<p>{signature:h}
</body>
</html>
