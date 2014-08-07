{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Sale price (internal list element)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.plain_price.tail.sale_price.text", weight="100")
 *}

{t(#Old price#)}: <span class="value">{formatPrice(getOldPrice(),null,1)}</span>
