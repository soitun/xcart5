/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function OrderEventDetails()
{
  jQuery(this.base).each(function (index, elem) {
    var $elem = jQuery(elem);
    var action = jQuery('#' + jQuery('.order-event-details', $elem).prop('id') + '-action');

    jQuery('.compact-view').on('click', function () {
      jQuery('.order-event-details.in').each(function (index, elem) {
        jQuery(elem).collapse('hide')
      });

      return false;
    });

    jQuery('.expanded-view').on('click', function () {
      jQuery('#orderHistory').collapse('show');
      jQuery('.order-event-details').each(function (index, elem) {
        jQuery(elem).collapse('show')
      });

      return false;
    });

    jQuery('.order-event-details', $elem)
      .on('show.bs.collapse', function () {
        action.removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
      })
      .on('hidden.bs.collapse', function () {
        action.removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
      });
  });
}

OrderEventDetails.prototype.base = 'li.event';

core.autoload('OrderEventDetails');
