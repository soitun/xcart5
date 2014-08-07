{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Block content : items
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="dashboard-center.welcome.content", weight="10")
 *}

<div class="step-items">
  <ul>
    <li class="item-store">{t(#Specify your _store information_#,_ARRAY_(#URL#^buildURL(#settings#,##,_ARRAY_(#page#^#Company#)))):h}</li>
    <li class="item-products">{t(#Add your _products_#,_ARRAY_(#URL#^buildURL(#product_list#))):h}</li>
    <li class="item-taxes">{t(#Setup _address zones_ and _taxes_#,_ARRAY_(#URL1#^buildURL(#zones#),#URL2#^buildURL(#tax_classes#))):h}</li>
    <li class="item-shipping">{t(#Configure _shipping methods_#,_ARRAY_(#URL#^buildURL(#shipping_methods#))):h}</li>
    <li class="item-payment">{t(#Choose _payment methods_#,_ARRAY_(#URL#^buildURL(#payment_settings#))):h}</li>
    <list name="admin-welcome-items" />
  </ul>
</div>


