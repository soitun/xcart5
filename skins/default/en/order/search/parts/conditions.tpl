{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Orders search conditions block
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="orders.search.base", weight="20")
 *}

 {*
 TODO: reimplement search orders form

<div class="search-orders-box">
  <div class="search-orders-conditions">
    <a IF="getTotalCount()" href="javascript:void(0);" onclick="javascript:core.toggleText(this,'Hide filter options','#advanced_search_order_options');">{t(#Show filter options#)}</a>
  </div>

  <div id="advanced_search_order_options" style="display:none;">
    <widget class="\XLite\View\Form\Order\Search" name="order_search_form" />
      <table cellspacing="0" class="form-table search-orders">
      <list name="orders.search.conditions" />
      </table>
    <widget name="order_search_form" end />
    <list name="orders.search.panel" />
  </div>
</div>

*}
