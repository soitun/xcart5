/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Checkout controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

/**
 * Main widget
 */
function CheckoutView(base)
{
  core.bind('checkout.main.postprocess', _.bind(this.assignHandlers, this))
    .bind('checkout.common.nonready', _.bind(this.handleNonReady, this))
    .bind('afterPopupPlace', _.bind(this.handleOpenPopup, this));

  jQuery('form.place').submit(_.bind(this.handlePlaceOrder, this));
  CheckoutView.superclass.constructor.apply(this, arguments);

  // Preload language labels
  core.loadLanguageHash(core.getCommentedData(jQuery('.checkout-block')));
}

extend(CheckoutView, ALoadable);

CheckoutView.autoload = function()
{
  jQuery('.checkout-block .steps').each(
    function() {
      new CheckoutView(this);
    }
  );
};

// Shade widget
CheckoutView.prototype.shadeWidget = true;

// Update page title
CheckoutView.prototype.updatePageTitle = false;

// Widget target
CheckoutView.prototype.widgetTarget = 'checkout';

// Widget class name
CheckoutView.prototype.widgetClass = '\\XLite\\View\\Checkout\\Steps';

CheckoutView.prototype.assignHandlers = function(event, state)
{
  if (state.isSuccess) {
    this.base.find('form.place')
      .removeAttr('onsubmit')
      .get(0).commonController
      .switchControlReadiness()
      .bind('local.ready', _.bind(this.handleChange, this))
      .bind('local.unready', _.bind(this.handleChange, this));
    this.base.find('form .agree-note a').click(_.bind(this.handleOpenTerms, this));
  }
};

CheckoutView.prototype.handleOpenPopup = function()
{
  jQuery('form.select-address .addresses > li').click(_.bind(this.handleSelectAddress, this));
};

CheckoutView.prototype.handleSelectAddress = function(event)
{
  var addressId = core.getValueFromClass(event.currentTarget, 'address');
  if (addressId) {
    var form = jQuery(event.target).parents('form').eq(0);
    if (form.length) {
      form.get(0).elements.namedItem('addressId').value = addressId;
      popup.openAsWait();
      form.get(0).submitBackground(
        function() {
          popup.close();
        }
      );
    }
  }

  return false;
};

CheckoutView.prototype.handleCheckoutBlock = function()
{
  this.base.find('button.place-order')
    .prop('disabled', 'disabled')
    .addClass('disabled')
    .attr('title', core.t('Order can not be placed because not all required fields are completed. Please check the form and try again.'));
};

CheckoutView.prototype.handleCheckoutUnblock = function()
{
  this.base.find('button.place-order')
    .removeProp('disabled')
    .removeClass('disabled')
    .removeAttr('title');
};

CheckoutView.prototype.handleOpenTerms = function(event)
{
  return !popup.load(
    event.currentTarget,
    {
      dialogClass: 'terms-popup'
    }
  );
};

CheckoutView.prototype.handlePlaceOrder = function(event)
{
  this.shade();
};

CheckoutView.prototype.handleNonReady = function(event)
{
  this.unshade();
};

CheckoutView.prototype.handleChange = function(event)
{
  core.trigger('checkout.common.anyChange', this);
};

// Get event namespace (prefix)
CheckoutView.prototype.getEventNamespace = function()
{
  return 'checkout.main';
};

// Autoload
core.autoload(CheckoutView);
