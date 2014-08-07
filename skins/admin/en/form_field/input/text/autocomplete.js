/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Float field microcontroller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

var box = {};

// Shade block with content
function shadeBlock()
{
  if (0 == jQuery(box).length) {
    return;
  }

  var overlay = jQuery(document.createElement('div'))
    .addClass('wait-overlay')
    .appendTo(box);
  var progress = jQuery(document.createElement('div'))
    .addClass('wait-overlay-progress')
    .appendTo(box);
  jQuery(document.createElement('div'))
    .appendTo(progress);

  overlay.width(box.outerWidth())
    .height(box.outerHeight());
}

function unshadeBlock()
{
  if (0 == jQuery(box).length) {
    return;
  }

  jQuery(box).find('.wait-overlay').remove();
  jQuery(box).find('.wait-overlay-progress').remove();

  box = {};
}

CommonForm.elementControllers.push(
  {
    pattern: '.input-field-wrapper input.auto-complete',
    handler: function () {

      if ('undefined' == typeof(this.autocompleteSource)) {
        this.autocompleteSource = function(request, response)
        {
          unshadeBlock();

          box = jQuery(this).parent('span');

          shadeBlock();

          core.get(
            unescape(jQuery(this).data('source-url')).replace('%term%', request.term),
            null,
            {},
            {
              dataType: 'json',
              success: function (data) {
                response(data);

                unshadeBlock();
              }
            }
          );
        }
      }

      if ('undefined' == typeof(this.autocompleteAssembleOptions)) {
        this.autocompleteAssembleOptions = function()
        {
          var input = this;

          return {
            source: function(request, response) {
              input.autocompleteSource(request, response);
            },
            minLength: jQuery(this).data('min-length') || 2,
            close: function() {jQuery(this).keyup()},
            select: function() {jQuery(this).dblclick()}
          };
        }
      }

      jQuery(this).autocomplete(this.autocompleteAssembleOptions());
    }
  }
);

