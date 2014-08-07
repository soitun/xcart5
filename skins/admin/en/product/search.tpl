{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product search form template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="\XLite\View\Form\Product\Search\Admin\Main" name="search_form" />
  <div id="search_conditions">
    <div class="search-conditions clear">
      <list name="product.search.conditions" />
    </div>
    <div class="search-conditions-hidden clear">
      <list name="product.search.conditions_hidden" />
    </div>
    <div class="clear"></div>
    <div class="arrow"></div>
  </div>
<widget name="search_form" end />
