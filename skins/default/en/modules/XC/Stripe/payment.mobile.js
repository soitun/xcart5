/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Stripe initialize
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

(function() {
  var handler = null;

  jQuery(document).bind(
    'pageshow',
    function(event)
    {
      var box = jQuery('.stripe-box');
      if (box.length && typeof(window.StripeCheckout) != 'undefined' && !handler) {
        var options = {
          key:   box.data('key'),
          token: function(token, args) {
            jQuery('.stripe-box .token').val(token.id);
            jQuery('form.place').submit();
          }
        };
        if (box.data('image')) {
          options.image = box.data('image');
        }
        handler = StripeCheckout.configure(options);
      }
    }
  );

  jQuery(document).bind(
    'pageshow',
    function()
    {
      jQuery('.checkout-block button.place-order').click(
        function() {
          var box = jQuery('.stripe-box');
          if (handler && box.length && !box.find('.token').val()) {
            var email = jQuery('#email').val();
            handler.open({
              name:        box.data('name'),
              description: box.data('description'),
              amount:      box.data('total'),
              currency:    box.data('currency'),
              email:       email ? email : box.data('email')
            });
          }

          // If no Stripe handler is defined the checkout must proceed as is.
          return handler ? false : true;
        }
      );
    }
  );
})();
