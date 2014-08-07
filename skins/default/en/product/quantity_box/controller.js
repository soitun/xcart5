/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Product quantity box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

/**
 * Controller
 */

function ProductQuantityBoxController(base)
{
  this.callSupermethod('constructor', arguments);

  if (this.base && this.base.length && jQuery('input.quantity', this.base).length > 0) {

    this.block = jQuery('input.quantity', this.base.get(0));

    if (!this.isCartPage) {

      this.actionButton = jQuery(this.base)
        .parents('div.product-buttons')
        .find('button.add2cart, button.buy-more');

    } else {

      this.actionButton = jQuery('ul.totals li.button button');

    }

    var o = this;

    this.block.bind(
      'blur keyup',
      function (event) {
        return !o.block.closest('form').validationEngine('validate')
          ? o.showError()
          : o.hideError();
      }
    );

    this.block.bind(
      'keypress',
      function (event) {
        return o.block.closest('form').validationEngine('validate') || (13 !== event.which);
      }
    );

  }
}

extend(ProductQuantityBoxController, AController);

// Controller name
ProductQuantityBoxController.prototype.name = 'ProductQuantityBoxController';

// Pattern for base element
ProductQuantityBoxController.prototype.findPattern = 'span.quantity-box-container';

// Controller associated main widget
ProductQuantityBoxController.prototype.block = null;

// Controller associated main widget
ProductQuantityBoxController.prototype.isCartPage = jQuery('div#cart').length > 0;

// Initialize controller
ProductQuantityBoxController.prototype.initialize = function()
{
  var o = this;

  this.base.bind(
    'reload',
    function(event, box) {
      o.bind(box);
    }
  );
};

/**
 * Show error
 */
ProductQuantityBoxController.prototype.showError = function()
{
  this.block.addClass('wrong-amount');

  this.actionButton
    .prop('disabled', 'disabled')
    .addClass('disabled add2cart-disabled');
};

/**
 * Hide error
 */
ProductQuantityBoxController.prototype.hideError = function()
{
  this.block.removeClass('wrong-amount');

  if (this.isCartPage && jQuery('input.wrong-amount').length > 0)
    return;

  this.actionButton
    .removeProp('disabled')
    .removeClass('disabled add2cart-disabled');
};

function bindQuantityBoxTriggers()
{
  var box = new ProductQuantityBoxController();
  jQuery('*:input', box.base).each(
    function() {
      new CommonElement(this);
    }
  );
}

function getQuantityBoxShadowWidgets()
{
  return '.widget-fingerprint-product-quantity, .widget-fingerprint-product-add-button';
}

core.registerTriggersBind('update-product-page', bindQuantityBoxTriggers);
core.registerShadowWidgets('update-product-page', getQuantityBoxShadowWidgets);
