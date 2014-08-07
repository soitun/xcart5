/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

CommonElement.prototype.handlers.push(
  {
    canApply: function () {
      return this.$element.is('select#methodid');
    },
    handler: function () {
      var count = 10;

      var handler = _.bind(
        function() {
          var widget = this.$element.next('.chosen-container');
          if (widget.length) {
            widget.find('.chosen-results li').each(
              _.bind(
                function(idx, elm) {
                  var oid = jQuery(elm).data('option-array-index');
                  var methodId = this.element.options[oid].value;
                  var html = jQuery('.shipping-rates-data li#shippingMethod' + methodId).html();
                  if (html) {
                    jQuery(elm).find('label span').html(html);
                  }
                },
                this
              )
            );

          } else if (count > 0) {
            count--;
            setTimeout(_.bind(arguments.callee, this), 500);
          }
        },
        this
      );

      handler();
    }
  }
);

