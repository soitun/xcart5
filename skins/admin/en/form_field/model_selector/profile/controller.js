/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Product selector controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

core.bind(
  'model-selector.profile.selected',
  function(event, data) {
    var $wrapper = jQuery(data.element).closest('.model-selector');

    jQuery('.model-not-defined', $wrapper).addClass('hidden');
    jQuery('.model-is-defined', $wrapper).html(data.data.selected_login).removeClass('hidden');

    jQuery(data.element).val(htmlspecialchars_decode(data.data.selected_value));
  }
);

CommonElement.prototype.handlers.push(
  {
    canApply: function () {
      return this.$element.is('.model-input-selector');
    },
    handler: function() {
      jQuery('.model-selector.data-type-profile .model-not-defined').removeClass('hidden');
    }
  }
);

core.bind(
  'model-selector.profile.not-selected',
  function(event, data) {
    var $wrapper = jQuery(data.element).closest('.model-selector');

    jQuery('.model-is-defined', $wrapper).html('').addClass('hidden');
    jQuery('.model-not-defined', $wrapper).removeClass('hidden');
  }
);
