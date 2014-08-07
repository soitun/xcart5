{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Orders list items block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="orders.children.view_all_items_link", weight="10")
 *}

<div IF={isMoreLinkVisible()} class="view-all-items-link">
  <a href="{buildURL(#order#,##,_ARRAY_(#order_number#^order.getOrderNumber()))}">{t(#View all ordered items#)}</a>
</div>