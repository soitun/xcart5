/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Payment methods list controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

/**
 * Payment template widget
 */

function PaymentTplView(base)
{
  var args = Array.prototype.slice.call(arguments, 0);
  if (!base) {
    args[0] = '.payment-tpl';
  }

  if (args[0].length) {
    core.bind('updateCart', _.bind(this.handleUpdateCart, this));
    this.bind('local.loaded', _.bind(this.handleLoaded, this));
  }

  PaymentTplView.superclass.constructor.apply(this, args);
};

extend(PaymentTplView, ALoadable);

// Shade widget
PaymentTplView.prototype.shadeWidget = true;

// Update page title
PaymentTplView.prototype.updatePageTitle = false;

// Widget target
PaymentTplView.prototype.widgetTarget = 'checkout';

// Widget class name
PaymentTplView.prototype.widgetClass = '\\XLite\\View\\Checkout\\Payment';

PaymentTplView.prototype.handleUpdateCart = function(event, data)
{
  if ('undefined' != typeof(data.paymentMethodId)) {
    this.load();
  }
};

PaymentTplView.prototype.handleLoaded = function(event)
{
  core.trigger('checkout.common.anyChange', this);
};

// Get event namespace (prefix)
PaymentTplView.prototype.getEventNamespace = function()
{
  return 'checkout.paymentTpl';
};

// Load
core.bind(
  'checkout.main.postprocess',
  function () {
    new PaymentTplView();
  }
);
