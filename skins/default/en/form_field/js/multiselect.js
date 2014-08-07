/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Multiselect microcontroller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

CommonElement.prototype.handlers.push(
  {
    canApply: function () {
      return 0 < this.$element.filter('select.multiselect').length;
    },
    handler: function () {
      this.$element.chosen();
      this.$element.next('.chosen-container').css({
        'width':     'auto',
        'min-width': this.$element.width()
      });
    }
  }
);
