{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Returns list table "order_number" cell
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<a href="{buildURL(#order#,##,_ARRAY_(#order_number#^entity.order.getOrderNumber()))}">{getColumnValue(column,entity)}</a>
