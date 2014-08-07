/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Sale widget controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

decorate(
  'CheckoutView',
  'postprocess',
  function(isSuccess, initial)
  {
    arguments.callee.previousMethod.apply(this, arguments);

    if (isSuccess) {
      jQuery(window).bind('message', _.bind(this.messageListener, this));

      jQuery('form.place').submit(
        _.bind(
          function() {
            if (jQuery('.xpc_iframe').length && !this.base.find('form.place').hasClass('allowed')) {
              var message = {
                message: 'submitPaymentForm',
                params:  {}
              };

              var xpcShown = jQuery('.xpc_iframe').get(0);

              if (window.postMessage && window.JSON) {
                xpcShown.contentWindow.postMessage(JSON.stringify(message), '*');
              }

              return false;
            }
          },
          this
        )
      );
    }
  }
);

CheckoutView.prototype.messageListener = function (event)
{
  var msg;

  try {
    msg = _.isString(event.originalEvent.data)
      ? JSON.parse(event.originalEvent.data)
      : event.originalEvent.data;

  } catch (e) {
  }

  if (msg && msg.message) {
    this.triggerVent('xpc.message', {widget: this, message: msg});
  }

  if (
    !msg
    || !msg.message
    || !(
      'paymentFormSubmitError' == msg.message
      || 'ready' == msg.message
    )
  ) {
    return;
  }

  if (msg.params.height) {
    jQuery("#xpc").css('height', msg.params.height);
  }

  if (msg.params.error && 0 != msg.params.type) {

    var type = parseInt(msg.params.type);
    var message = escape(msg.params.error);

    popup.load(URLHandler.buildURL({ 'target': 'xpc_popup', 'type': type, 'message': message }));

    this.triggerVent('xpc.error', {widget: this, error: msg.params.error, type: msg.params.type});
  }

  if (msg.params.returnURL) {

    this.base.find('form.place').addClass('allowed').get(0).setAttribute('action', msg.params.returnURL);
    this.base.find('form.place input[name="action"]').val('return');
    this.base.find('.bright').removeClass('disabled').removeClass('submitted').click().addClass('submitted');

    this.triggerVent('xpc.redirect', {widget: this});

    // Doesn't seem to be a best or supposed way
    // However, it INDEED submits the form
    $('form.place').submit();

  } else {

    xpcLoading = false;
    xpcShadeFlag = false;
    jQuery('.save-card-box').show();
    jQuery(xpcAllWidget).get(0).loadable.unshade();
    jQuery(xpcSmallWidget).get(0).loadable.unshade();
    core.trigger('checkout.common.anyChange');

    this.triggerVent('xpc.unshade', {widget: this});

    this.base.find('.bright').removeClass('submitted');
  }
}

var xpcSmallWidget = '.cart-items';
var xpcWrongWidget = '.payment-tpl';
var xpcAllWidget = '.steps';

var xpcLoading = false;
var xpcShadeFlag = false;

core.bind(
  'load',
  function() {

    decorate(
      'CartItemsView',
      'unshade',
      function(isSuccess, initial) {
        if (!xpcLoading) {
          arguments.callee.previousMethod.apply(this, arguments);
        }
      }
    );

    decorate(
      'CartItemsView',
      'switchCards',
      function (isSuccess, initial) {
        jQuery('.saved-cards').children().each(
          function () {
            jQuery(this).removeClass('hidden');
          }
        );
        jQuery('.saved-cards').removeClass('single');
        jQuery('.switch-cards-link').hide();
      }
    );

    if (typeof(xpcPaymentIds) !== "undefined" && xpcPaymentIds[currentPaymentId]) {
      jQuery('.bright').addClass('disabled');
    }

    core.bind(
      'checkout.cartItems.postprocess',
      function(event, data) {
        if (typeof(xpcPaymentIds) !== "undefined" && xpcPaymentIds[currentPaymentId]) {
          xpcLoading = true;
          if (jQuery('.save-card-box').length) {
            jQuery('.save-card-box').hide();

          } else {
            jQuery('.bright').addClass('disabled');
          }
        }
      }
    );

    core.bind(
      'checkout.cartItems.shaded',
      function(event, data) {
        xpcShadeFlag = true;
      }
    );

    core.bind(
      'checkout.cartItems.unshaded',
      function(event, data) {
        xpcShadeFlag = false;
      }
    );

    core.bind(
      'checkout.paymentTpl.shade',
      function(event, state) {
        if (state.result && jQuery(xpcSmallWidget).get(0).loadable.isShowModalScreen) {
          state.result = false;
        }
      }
    );

    core.bind(
      'checkout.paymentTpl.postprocess',
      function(event, state) {
        var iframe = state.widget.base.find('.xpc_iframe')
        iframe.attr('src', iframe.data('src'));
      }
    );

    core.bind(
      'checkout.common.state.nonready',
      function(event, state) {
        jQuery('.xpc-box').hide();
      }
    );

    core.bind(
      'checkout.common.state.blocked',
      function(event, state) {
        jQuery('.xpc-box').show();
      }
    );

    core.bind(
      'checkout.common.state.ready',
      function(event, state) {
        jQuery('.xpc-box').show();
      }
    );

    core.bind(
      'updateCart',
      function(event, data) {

        xpcLoading = false;

        if (
          data.shippingMethodId
          || data.shippingAddressId
          || data.total
        ) {

          var iframe = jQuery('.xpc_iframe');

          if (iframe.length) {
            xpcLoading = true;
            jQuery('.save-card-box').hide();
            jQuery(xpcSmallWidget).get(0).loadable.shade();
            iframe.attr('src', iframe.attr('src'));
          }

        } else if (
          data.paymentMethodId
          && xpcPaymentIds
          && xpcPaymentIds[data.paymentMethodId]
        ) {
          xpcLoading = true;
          jQuery('.save-card-box').hide();
          jQuery(xpcSmallWidget).get(0).loadable.shade();
        }
      }
    );

  }
);
