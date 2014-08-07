/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Drupal-specific controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

var ga = {};

/**
 * Registers the search text event
 *
 * @param string substring Search text
 *
 * @return void
 */
ga.gaRegisterSearchEvent = function (substring)
{
  _gaq.push([
    '_trackEvent',
    'search',
    'do_search',
    substring
  ]);
};

ga.searchTextPattern = ".search-product-form input[name='substring']";

jQuery().ready(
  function() {

    // Detect add to cart
    core.bind(
      'updateCart',
      function(event, data) {

        if ('undefined' != typeof(window._gaq)) {
          if (data.items) {
            for (var i = 0; i < data.items.length; i++) {
              var item = data.items[i];

              if (item.quantity_change > 0 && item.quantity_change == item.quantity) {

                // Add to cart
                _gaq.push(['_trackEvent', 'cart', 'add', item.key, item.quantity_change]);

              } else if (item.quantity_change < 0 && (item.quantity == 0 || (item.quantity + item.quantity_change) <= 0)) {

                // Remove from cart
                _gaq.push(['_trackEvent', 'cart', 'remove', item.key, item.quantity_change]);

              } else {

                // Change quantity
                _gaq.push(['_trackEvent', 'cart', 'change', item.key, item.quantity_change]);
              }
            }
          }

          if (data.shippingMethodId) {

           // Change shipping method
           _gaq.push(['_trackEvent', 'cart', 'changeShippingMethod', data.shippingMethodId]);
          }

          if (data.paymentMethodId) {

           // Change payment method
           _gaq.push(['_trackEvent', 'cart', 'changePaymentMethod', data.paymentMethodId]);
          }

        }
      }
    );

  }
);

