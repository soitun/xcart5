/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Date field controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

CommonElement.prototype.handlers.push(
  {
    canApply: function () {
      return this.$element.is('input.datepicker');
    },
    handler: function() {
      this.$element.datepicker();
    }
  }
);
