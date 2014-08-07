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
    pattern: '.input-field-wrapper div.combobox-select',
    handler: function () {

      jQuery(this).click(
        function () {
          var input = jQuery(this).parent().find('input');
          var minLength = input.autocomplete('option', 'minLength');
          input.autocomplete('option', 'minLength', 0);
          input.autocomplete('search', '');
          input.autocomplete('option', 'minLength', minLength);
          input.focus();
        }
      );
    }
  }
);
