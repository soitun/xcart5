/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Average rating controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

CommonForm.elementControllers.push(
  {
    pattern: '.button-average-rating',
    handler: function () {
      jQuery(this)
        .click(function() {
          jQuery('.product-average-rating-container').toggle();
        });
    }
  }
);

CommonForm.elementControllers.push(
  {
    pattern: 'div.vote-bar',
    handler: function () {

      var $tooltip = jQuery(this).closest('div').parent().children('.rating-tooltip');
      var $div = jQuery(this).closest('div');

      $div
        .hover(
          function() {
            $tooltip.css({'display': 'block'});
          },
          function() {
            $tooltip.css({'display': 'none'});
          }
        );
    }
  }
);
