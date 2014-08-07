/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Orders list controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */
function OrderDetails()
{
  jQuery(this.base).each(function (index, elem) {
    var $elem = jQuery(elem);
    var action = jQuery('#' + jQuery('.order-body-items-list', $elem).prop('id') + '-action');

    jQuery('.order-body-items-list', $elem)
      .on('show.bs.collapse', function () {
        action.removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
      })
      .on('hidden.bs.collapse', function () {
        action.removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
      });
  });

  jQuery('i', this.base).eq(0).click();
}

OrderDetails.prototype.base = '.order-body-item';

core.autoload('OrderDetails');
