/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Product comparison
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

core.bind(
  'load',
  function() {
    decorate(
      'ProductDetailsView',
      'postprocess',
      function(isSuccess, initial)
      {
        arguments.callee.previousMethod.apply(this, arguments);

        if (isSuccess) {
          jQuery('div.add-to-compare.product').mouseleave(
            function() {
              jQuery(this).find('div.compare-popup').removeClass('visible');
            }
          );
    
          product_comparison();
        }
      }
    );
  }
);
