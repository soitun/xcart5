/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Cart controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

/**
 * Main widget
 */

function CartView(base)
{
  this.bind('local.postprocess', _.bind(this.assignHandlers, this));

  this.callSupermethod('constructor', arguments);

  core.bind('updateCart', _.bind(this.handleUpdateCart, this));

  this.validate();
}

extend(CartView, ALoadable);

CartView.autoload = function()
{
  jQuery('#cart').each(
    function() {
      new CartView(this);
    }
  );
};

// Shade widget
CartView.prototype.shadeWidget = true;

// Update page title
CartView.prototype.updatePageTitle = true;

// Update breadcrumb last node from loaded request or not
CartView.prototype.updateBreadcrumb = true;

// Widget target
CartView.prototype.widgetTarget = 'cart';

// Widget class name
CartView.prototype.widgetClass = '\\XLite\\View\\Cart';

// Checkout button
CartView.prototype.checkoutButton = jQuery('#cart ul.totals li.button button');

// Widget updated status
CartView.prototype.selfUpdated = false;

// Cart silence updated status
CartView.prototype.cartUpdated = false;

// Postprocess widget
CartView.prototype.assignHandlers = function(event, state)
{
  if (state.isSuccess) {

    // Item subtotal including scharges
    jQuery('td.item-subtotal div.including-modifiers', this.base).each(
      function() {
        attachTooltip(
          jQuery(this).parents('td.item-subtotal').find('.subtotal'),
          jQuery(this).html()
        );
      }
    );

    // Cart subtotal including scharges
    jQuery('.totals li.subtotal div.including-modifiers', this.base).each(
      function() {
        attachTooltip(
          jQuery(this).parents('li.subtotal').find('.cart-subtotal'),
          jQuery(this).html()
        );
      }
    );

    // Remove item
    this.base.find('.selected-product form input.remove').parents('form')
      .commonController(
        'enableBackgroundSubmit',
        _.bind(this.preprocessAction, this),
        _.bind(this.postprocessAction, this)
      );

    // Update item
    jQuery('.selected-product form.update-quantity', this.base)
      .commonController(
        'enableBackgroundSubmit',
        _.bind(this.preprocessAction, this),
        _.bind(this.postprocessAction, this)
      )
      .commonController('submitOnlyChanged', true);

    // Clear cart
    jQuery('form .clear-bag', this.base).parents('form').eq(0)
      .commonController(
        'enableBackgroundSubmit',
        _.bind(this.preprocessAction, this),
        _.bind(this.postprocessAction, this)
      );

    // Shipping estimator
    jQuery('.estimator button.estimate', this.base).parents('form').eq(0).submit(
      _.bind(
        function(event) {
          return this.openShippingEstimator(event, event.currentTarget);
        },
        this
      )
    );
    jQuery('.estimator a.estimate', this.base).click(
      _.bind(
        function(event) {
          return this.openShippingEstimator(event, event.currentTarget);
        },
        this
      )
    );

  }
};

CartView.prototype.preprocessAction = function()
{
  var result = false;

  if (!this.selfUpdated) {
    this.selfUpdated = true;
    this.shade();

    // Remove validation errors from other quantity boxes
    jQuery('form.validationEngine', this.base).validationEngine('hide');

    result = true;
  }

  return result;
};

// Open Shipping estimator popup
CartView.prototype.openShippingEstimator = function(event, elm)
{
  if (!this.selfUpdated && !this.submitTO) {
    this.selfUpdated = true;
    core.bind('afterPopupPlace',function() {UpdateStatesList();});
    popup.load(
      elm,
      _.bind(
        function(event) {
          this.closePopupHandler();
        },
        this
      )
    );
  }

  return false;
};

// Close Shipping estimator popup handler
CartView.prototype.closePopupHandler = function()
{
  if (this.cartUpdated) {
    this.load();
  }

  this.selfUpdated = false;
  this.cartUpdated = false;
};

// Validate using validation engine plugin
CartView.prototype.validate = function()
{
  if (!jQuery('form.validationEngine', this.base).validationEngine('validate')) {
    this.checkoutButton.prop('disabled','disabled')
      .addClass('disabled add2cart-disabled');
  }
};

// Form POST processor
CartView.prototype.postprocessAction = function(event, data)
{
  this.selfUpdated = false;
  this.cartUpdated = false;

  if (data.isValid) {
    this.load();

  } else {
    this.unshade();
  }
};

CartView.prototype.handleUpdateCart = function(event, data)
{
  if (this.selfUpdated) {
    this.cartUpdated = true;

  } else {
    this.load();
  }
};

// Get event namespace (prefix)
CartView.prototype.getEventNamespace = function()
{
  return 'cart.main';
};

core.autoload(CartView);
