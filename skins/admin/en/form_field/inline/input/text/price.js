/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Price field controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

CommonForm.elementControllers.push(
  {
    pattern: '.inline-field.inline-price',
    handler: function () {

      jQuery('.field :input', this).eq(0).bind('sanitize', function () {
        var input = jQuery(this);
        var value = core.stringToNumber(input.val(), ".", "");

        input.val(value);
      });

      this.viewValuePattern = '.view .value';

      this.sanitize = function ()
      {
        var input = jQuery('.field :input', this).eq(0);

        if (input.length) {

          input.val(input.get(0).sanitizeValue(input.val(), input));
        }
      };

      this.getFieldFormattedValue = function ()
      {
        var input = jQuery('.field :input', this).eq(0);
        var dDelim = input.data('decimal-delim');
        var tDelim = input.data('thousand-delim');

        return core.numberToString(input.val(), dDelim, tDelim);
      };

    }
  }
);
