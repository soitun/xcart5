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
    pattern: '.inline-field.inline-color',
    handler: function () {

      var field = jQuery(this);

      var input = jQuery('.field :input.color', this).eq(0);

      // Check - process blur event or not
      this.isProcessBlur = function()
      {
        return !input.data('colorpicker-show');
      }

      // Save field into view
      this.saveField = function()
      {
        field.find(this.viewValuePattern).find('.value').css('background-color', '#' + this.getFieldFormattedValue());
      }

    }
  }
);
