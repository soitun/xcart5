{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Item price
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.product.modify.common.admin.header", weight="60")
 *}

<th class="price"><widget template="items_list/sort.tpl" title='{t(#Price#)} <span class="currency">({xlite.currency.getSymbol()})</span>' sortByColumn="{%static::SORT_BY_MODE_PRICE%}" /></th>
