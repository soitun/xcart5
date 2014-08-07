{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product search form template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="search-product-form">

  <widget class="\XLite\View\Form\Product\Search\Customer\Main" name="simple_products_search" />

  <div class="search-form">

    <table class="search-form-main-part">

      <tr>
        <list name="products.search.conditions.substring" />
      </tr>

      <tr class="including-options-list">

        <td>

          <ul class="search-including-options">
            <list name="products.search.conditions.phrase" />
          </ul>

        </td>

        <td class="less-search-options-cell hidden-xs hidden-sm">
          <a href="javascript:void(0);" onclick="javascript:core.toggleText(this,'{t(#Less search options#)}','#advanced_search_options');">{t(#More search options#)}</a>
        </td>

    </table>

    <table id="advanced_search_options" class="advanced-search-options">
      <list name="products.search.conditions.advanced" />
    </table>
    
    <table class="search-form-main-part visible-xs visible-sm">
        <tr>
           <list name="products.search.conditions-responsive.substring" />
        </tr>
        <tr>
          <td class="less-search-options-cell">
            <a href="javascript:void(0);" onclick="javascript:core.toggleText(this,'{t(#Less search options#)}','#advanced_search_options');">{t(#More search options#)}</a>
          </td>  
        </tr>
    </table>

  </div> 
  
  
  {*<!-- <div class="search-form">
    
    <div class="search-form-main-part">
        <div class="">
            <div class="input-search">
                <list name="products.search.conditions.substring" />
            </div>
            <div class="less-search-options-cell">
                <a href="javascript:void(0);" onclick="javascript:core.toggleText(this,'{t(#Less search options#)}','#advanced_search_options');">{t(#More search options#)}</a>
            </div>
        </div>
        <div class="including-options-list">
            <ul class="search-including-options">
                <list name="products.search.conditions.phrase" />
            </ul>
        </div>
    </div>

    <table id="advanced_search_options" class="advanced-search-options">
      <list name="products.search.conditions.advanced" />
    </table>

  </div> -->*}
  
  
  

  <widget name="simple_products_search" end />

</div>

<widget class="\XLite\View\ItemsList\Product\Customer\Search" />
