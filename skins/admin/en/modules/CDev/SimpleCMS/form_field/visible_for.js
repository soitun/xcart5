/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Discount type field controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

CommonForm.elementControllers.push(
  {
    pattern: '.inline-field.inline-visible-for',
    handler: function () {
      this.viewValuePattern = '.view';
      this.fieldValuePattern = '.field select option:selected';
      this.saveField = function()
      {        
        jQuery(this).find(this.viewValuePattern).html(jQuery(this.fieldValuePattern, jQuery(this)).html());
      };
    }
  }
);
