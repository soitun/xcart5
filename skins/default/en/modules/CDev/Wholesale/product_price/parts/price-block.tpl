{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Wholesale prices table
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="wholesale.price", weight="20")
 *}

<table class="wholesale-prices-product-block">

  <tr class="price-row" FOREACH="getWholesalePrices(),wholesalePrice">

    <list type="nested" name="widgetlist" wholesalePrice="{wholesalePrice}" />

  </tr>

</table>
