/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Shipping methods list controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

/**
 * Shipping methods list widget
 */

function ShippingMethodsView(base)
{
  var args = Array.prototype.slice.call(arguments, 0);
  if (!base) {
    args[0] = 'form.shipping-methods';
  }

  this.bind('local.postprocess', _.bind(this.assignHandlers, this))
    .bind('local.loaded', _.bind(this.triggerChange, this));

  core.bind('updateCart', _.bind(this.handleUpdateCart, this))
    .bind('createShippingAddress', _.bind(this.handleCreateAddress, this))
    .bind('checkout.common.readyCheck', _.bind(this.handleCheckoutReadyCheck, this))

  ShippingMethodsView.superclass.constructor.apply(this, args);
}

extend(ShippingMethodsView, ALoadable);

// Shade widget
ShippingMethodsView.prototype.shadeWidget = true;

// Update page title
ShippingMethodsView.prototype.updatePageTitle = false;

// Widget target
ShippingMethodsView.prototype.widgetTarget = 'checkout';

// Widget class name
ShippingMethodsView.prototype.widgetClass = '\\XLite\\View\\Checkout\\ShippingMethodsList';

// Postprocess widget
ShippingMethodsView.prototype.assignHandlers = function(event, state)
{
  if (state.isSuccess) {

    // Check and save shipping methods
    this.base
      .commonController('enableBackgroundSubmit')
      .find('ul.shipping-rates input')
      .change(_.bind(this.handleMethodChange, this));

    this.base
      .find('select#methodid')
      .change(_.bind(this.handleMethodChange, this));

    this.base.get(0).commonController
      .bind('local.submit.preprocess', _.bind(this.triggerChange, this))
      .bind('local.submit.success', _.bind(this.triggerChange, this))
      .bind('local.submit.success', _.bind(this.unshadeDelayed, this))
      .bind('local.submit.error', _.bind(this.unshade, this));
  }
}

ShippingMethodsView.prototype.handleUpdateCart = function(event, data)
{
  if ('undefined' != typeof(data.shippingMethodsHash)) {
    this.load();
  }
}

ShippingMethodsView.prototype.handleCreateAddress = function()
{
  this.load();
}

ShippingMethodsView.prototype.handleMethodChange = function(event)
{
  this.shade();

  return this.base.submit();
}

ShippingMethodsView.prototype.handleCheckoutReadyCheck = function(event, state)
{
  if (0 < this.base.find('ul.shipping-rates input').length) {
    state.result = (0 < this.base.find('ul.shipping-rates input:checked').length)
      && state.result;

  } else if (0 < this.base.find('select#methodid').length) {
    state.result = (0 <= this.base.find('select#methodid').get(0).selectedIndex)
      && state.result;

  } else {
    state.result = false;
  }

  state.blocked = this.base.get(0).isBgSubmitting
    || this.base.get(0).commonController.isChanged()
    || this.isLoading
    || state.blocked;
}

ShippingMethodsView.prototype.unshadeDelayed = function()
{
  setTimeout(
    _.bind(this.unshade, this),
    500
  );
}

ShippingMethodsView.prototype.triggerChange = function()
{
  core.trigger('checkout.common.anyChange', this);
}

// Get event namespace (prefix)
ShippingMethodsView.prototype.getEventNamespace = function()
{
  return 'checkout.shippingMethods';
}

// Load
core.bind(
  'checkout.main.postprocess',
  function () {
    new ShippingMethodsView();
  }
);

