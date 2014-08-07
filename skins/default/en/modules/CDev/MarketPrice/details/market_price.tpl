{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Market price (internal list element)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.plain_price.tail.market_price.text", weight="100")
 *}

{t(#Market price#)}: <span class="value">{formatPrice(product.getMarketPrice(),null,1)}</span>,
