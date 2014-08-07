/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Subtotal field controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

CommonForm.elementControllers.push(
  {
    pattern: '.inline-field.inline-quantityRangeBegin',
    handler: function () {

      this.viewValuePattern = '.view .value';

      this.saveField = function(input)
      {
        var inputs = jQuery('.field :input', this);

        var input = inputs.eq(0);

        var result = '';

        if (input) {
          result = input.val();
        }

        jQuery(this).find(this.viewValuePattern).html(result);
      }

    }
  }
);
