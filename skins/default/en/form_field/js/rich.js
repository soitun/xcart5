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
      return 0 < this.$element.filter('select.rich').length;
    },
    handler: function () {
      var options = {};
      if (this.$element.data('disable-search') == 1) {
        options.disable_search = true;
      }
      this.$element.chosen(options);
      this.$element.next('.chosen-container').css({
        'width':     'auto',
        'min-width': this.$element.width()
      });
    }
  }
);
