{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product price value
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.plain_price", weight="10")
 *}

<li IF="participateSale()" class="sale-banner">
  <div class="sale-banner-block">
    <div class="text">{t(#sale#)}</div>
    <div class="percent">{t(#percent X off#,_ARRAY_(#percent#^getSalePercent())):h}</div>
  </div>
</li>
