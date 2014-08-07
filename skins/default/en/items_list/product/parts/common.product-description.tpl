{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Item description
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.list.customer.info", weight="30")
 *}
<div IF="product.getBriefDescription()" class="description product-description">{product.getBriefDescription():h}</div>
