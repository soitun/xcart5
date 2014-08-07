{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="main-text">

  <div class="no-modules-found" IF="getSearchSubstring()">
    {t(#No modules found for search_string#,_ARRAY_(#search_string#^getSearchSubstring())):h}
  </div>

  <div class="no-modules-found" IF="!getSearchSubstring()">
    {t(#No modules found#)}
  </div>

  <div class="clarify-text" IF="getSearchSubstring()">
    {t(#Please, clarify your search request or search in Marketplace#,_ARRAY_(#marketplace#^buildURL(#addons_list_marketplace#))):h}
  </div>

</div>
