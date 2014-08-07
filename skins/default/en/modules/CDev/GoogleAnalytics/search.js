/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Drupal-specific controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function() {
    if ('undefined' != typeof(window._gaq)) {
      // Register "Search" event
      ga.gaRegisterSearchEvent(jQuery(ga.searchTextPattern).val());

      jQuery(".search-product-form button[type='submit']").click(function (event) {
        ga.gaRegisterSearchEvent(jQuery(ga.searchTextPattern).val());
      });
    }
  }
);

