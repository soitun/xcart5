/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Value range 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

// Decoration of the products list widget class
core.bind(
  'load',
  function() {
    jQuery('div.value-range').not('.assigned').each(
      function() {
        var min_value = jQuery(this).find('.min-value');
        var min_default = parseFloat(min_value.attr('placeholder'));
        var max_value = jQuery(this).find('.max-value');
        var max_default = parseFloat(max_value.attr('placeholder'));
        var select = jQuery(this);
        select.addClass('assigned');
        var slider = jQuery('<div></div>').appendTo(select).slider({
          range: true,
          step: max_default - min_default < 10 ? Math.floor((max_default - min_default) / 10) : 1,
          min: min_default,
          max: max_default,
          values: [
              min_value.val() ? min_value.val() : min_default,
              max_value.val() ? max_value.val() : max_default
          ],
          slide: function( event, ui ) {
            min_value.val(min_default < ui.values[0] ? ui.values[0] : '').change();
            max_value.val(max_default > ui.values[1] ? ui.values[1] : '').change();
          }
        });
        min_value.change(function() {
          var value = parseFloat(min_value.val());
          if (!value) {
            value = min_default;
          } else {
            value = Math.max(min_default, value);
          }
          if (max_value.val()) {
            value = Math.min(value, max_value.val());
          }
          slider.slider('values', 0, value);
          min_value.val(min_default < value ? value : '');
        });
        max_value.change(function() {
          var value = parseFloat(max_value.val());
          if (!value) {
            value = max_default;
          } else {
            value = Math.min(max_default, value);
          }
          if (min_value.val()) {
            value = Math.max(value, min_value.val());
          }
          slider.slider('values', 1, value);
          max_value.val(max_default > value ? value : '');
        });
      }
    );
  }
);
