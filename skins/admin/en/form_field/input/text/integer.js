/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Float field microcontroller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

CommonForm.elementControllers.push(
  {
    pattern: '.input-field-wrapper input.integer',
    handler: function () {

      this.sanitizeValue = function (value)
      {
        value = Math.round(value);

        return isNaN(value) ? 0 : value;
      }

      this.commonController.isEqualValues = function (oldValue, newValue, element)
      {
        return this.element.sanitizeValue(oldValue) == this.element.sanitizeValue(newValue);
      }

    }
  }
);

