{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product market price
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.plain_price.tail", weight="45")
 *}

<div IF="isShowMarketPrice()" class="product-details-market-price">
  <div class="text">
    <list name="market_price.text" type="nested" />
  </div>
  <list name="market_price.label" type="nested" />
</div>
