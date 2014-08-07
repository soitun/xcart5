{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Body
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="product-filter">
  <div class="{getBlockClasses()}">
    <h2>{t(getHead())}</h2>
    <div class="content">
      <widget class="\XLite\Module\XC\ProductFilter\View\Form\Filter" name="filter_form" category="{getCategory()}" />
        <list name="sidebar.filter" />
        <div class="buttons">
          <div class="popup">
            <a href="#" class="show-products">{t(#Show products#)}</a>
            <div class="arrow"> </div>
          </div>
          <widget class="\XLite\View\Button\Submit" label="Show products" style="filter" />
          <a href="#" class="reset-filter">{t(#Reset filter#)}</a>
        </div>
      <widget name="filter_form" end />
    </div>
  </div>
</div>
