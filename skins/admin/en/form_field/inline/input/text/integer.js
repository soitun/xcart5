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
    pattern: '.inline-field.inline-integer',
    handler: function () {

      this.sanitize = function ()
      {
        var input = jQuery('.field :input', this).eq(0);
        if (input.length) {
          input.val(input.get(0).sanitizeValue(input.val()));
        }
      }

    }
  }
);
