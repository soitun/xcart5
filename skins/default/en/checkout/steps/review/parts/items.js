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
 * Itemcs list widget
 */
function CartItemsView(base)
{
  var args = Array.prototype.slice.call(arguments, 0);
  if (!base) {
    args[0] = jQuery('.cart-items').eq(0);
  }

  core.bind('checkout.cartItems.postprocess', _.bind(this.assignHandlers, this));
  core.bind('updateCart', _.bind(this.handleUpdateCart, this));

  CartItemsView.superclass.constructor.apply(this, args);
};

extend(CartItemsView, ALoadable);

// Shade widget
CartItemsView.prototype.shadeWidget = true;

// Update page title
CartItemsView.prototype.updatePageTitle = false;

// Widget target
CartItemsView.prototype.widgetTarget = 'checkout';

// Widget class name
CartItemsView.prototype.widgetClass = '\\XLite\\View\\Checkout\\CartItems';

// Postprocess widget
CartItemsView.prototype.assignHandlers = function(event, state)
{
  if (state.isSuccess) {

    // Items list switcher
    this.base.find('.items-row a', this.base).click(_.bind(this.handleItemClick, this));
  }
};

CartItemsView.prototype.handleItemClick = function(event)
{
  if (this.base.find('.list:visible').length) {
    this.base.find('.list').hide();

  } else {
    this.base.find('.list').show();
  }

  return false;
}

CartItemsView.prototype.handleUpdateCart = function(event, data)
{
  var intersect = _.intersection(
    _.keys(data),
    ['items', 'total']
  );

  if (0 < intersect.length) {
    this.load();
  }
}

// Get base element for shade / unshade operation
CartItemsView.prototype.getShadeBase = function()
{
  return this.base.parents('.step-box').eq(0);
}

// Get event namespace (prefix)
CartItemsView.prototype.getEventNamespace = function()
{
  return 'checkout.cartItems';
}

// Load
core.bind(
  'checkout.main.postprocess',
  function () {
    new CartItemsView();
  }
);

