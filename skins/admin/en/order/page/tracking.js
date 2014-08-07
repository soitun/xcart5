/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Order info form controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function OrderTrackingInfo()
{
  this.base = jQuery('.tracking-number');

  var form = this.base.parents('form').eq(0);
  form.bind(
    'state-changed',
    _.bind(this.markAsChanged, this)
  );
  form.bind(
    'state-initial',
    _.bind(this.unmarkAsChanged, this)
  );
}

OrderTrackingInfo.prototype.markAsChanged = function ()
{
  jQuery('.send-tracking').addClass('disabled').prop('disabled', true);
};

OrderTrackingInfo.prototype.unmarkAsChanged = function ()
{
  jQuery('.send-tracking').removeClass('disabled').prop('disabled', false);
};

core.autoload(OrderTrackingInfo);