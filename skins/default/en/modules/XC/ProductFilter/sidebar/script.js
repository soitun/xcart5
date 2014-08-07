/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Product filter
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

/**
 * Widget
 */
function ProductFilterView(base)
{
  this.callSupermethod('constructor', arguments);
  var o = this;
  core.bind(
    'updateProductFilter',
    function(event, data) {
      o.load();
    }
  );
}

extend(ProductFilterView, ALoadable);

ProductFilterView.autoload = function(){
  new ProductFilterView(jQuery('.product-filter'));
};

// No shade widget
ProductFilterView.prototype.shadeWidget = false;

// Widget target
ProductFilterView.prototype.widgetTarget = 'main';

// Widget class name
ProductFilterView.prototype.widgetClass = '\\XLite\\Module\\XC\\ProductFilter\\View\\Filter';

// Body handler is binded or not
ProductFilterView.prototype.bodyHandlerBinded = false;

// Postprocess widget
ProductFilterView.prototype.postprocess = function(isSuccess)
{
  this.callSupermethod('postprocess', arguments);

  if (isSuccess) {
    var o = this;
    jQuery('.table-label.collapsible').click(
        function() {
            if (jQuery(this).hasClass('collapsed')) {
                jQuery(this).removeClass('collapsed');
                jQuery(this).parent().find('.table-value.collapsible').removeClass('collapsed');
            } else {
                jQuery(this).addClass('collapsed');
                jQuery(this).parent().find('.table-value.collapsible').addClass('collapsed');
            }
        }
    );

    jQuery('.product-filter a.reset-filter').click(
        function() {
            jQuery('.product-filter').find('input[type=\'checkbox\']:checked').each(function() {
                jQuery(this).click();
            });
            jQuery('.product-filter').find('input[type=\'text\']').each(function() {
                jQuery(this).val('').change();
            });
            jQuery('.product-filter .popup').hide();
            jQuery('form.filter-form').submit();
            return false;
        }
    );

    jQuery('.type-c input[type=\'checkbox\']').change(
        function() {
            if (jQuery(this).prop('checked')) {
              jQuery(this).parent().parent().parent().addClass('checked');
            } else {
              jQuery(this).parent().parent().parent().removeClass('checked');
            }
        }
    );

    jQuery('.type-s input[type=\'checkbox\']').change(
        function() {
            if (jQuery(this).prop('checked')) {
              jQuery(this).parent().addClass('checked');
            } else {
              jQuery(this).parent().removeClass('checked');
            }
        }
    );

    jQuery('a.show-products').click(
        function() {
            jQuery('form.filter-form').submit();
            return false;
        }
    );

    jQuery('.product-filter input[type=\'checkbox\'],.product-filter input[type=\'text\']').change(
        function() {
            var popup = jQuery('.product-filter .popup');
            popup.css('top', jQuery(this).offset().top - jQuery('.product-filter').offset().top - 60).show();
            clearTimeout(popup.attr('timerId'));
            popup.attr('timerId', setTimeout("jQuery('.product-filter .popup').hide()", 4000));
        }
    );
  }
}

core.autoload(ProductFilterView);

/**
 * Decoration of the products list widget class
 */
core.bind(
  'load',
  function() {
    decorate(
      'ProductsListView',
      'postprocess',
      function(isSuccess, initial)
      {
        arguments.callee.previousMethod.apply(this, arguments);

        if (isSuccess) {
          var o = this;

          if (jQuery(this.base).hasClass('filtered-products')) {

            jQuery('form.filter-form').unbind('submit').submit(
              function () {
                if (!jQuery(this).hasClass('disabled')) {
                  jQuery('form.filter-form button').addClass('disabled');
                  jQuery(this).addClass('disabled');
                  if (
                    o.submitForm(
                      this,
                      function (XMLHttpRequest, textStatus, data, isValid) {
                        if (isValid) {
                          o.load();
                        } else {
                          o.unshade();
                        }
                      }
                    )
                  ) {
                    o.shade();
                  }
                }

                return false;
              }
            );

          }

          jQuery('form.filter-form button').removeClass('disabled');
          jQuery('form.filter-form').removeClass('disabled');
        } // if (isSuccess) {
      } // function(isSuccess, initial)
    ); // 'postprocess' method decoration (EXISTING method)
  }
); // core.bind()
