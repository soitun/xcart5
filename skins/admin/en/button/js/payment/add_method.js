/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Add payment method JS controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonAddPaymentMethod()
{
  PopupButtonAddPaymentMethod.superclass.constructor.apply(this, arguments);
}

// New POPUP button widget extends POPUP button class
extend(PopupButtonAddPaymentMethod, PopupButton);

// New pattern is defined
PopupButtonAddPaymentMethod.prototype.pattern = '.add-payment-method-button';

decorate(
  'PopupButtonAddPaymentMethod',
  'callback',
  function (selector)
  {
    jQuery('.tooltip-main').each(
      function () {
        attachTooltip(
          jQuery('img', this),
          jQuery('.help-text', this).hide().html()
        );
      }
    );

    jQuery('.headers .header').click(function () {
      jQuery('.headers .header, .body .body-item').removeClass('selected');

      jQuery(this).hasClass('all-in-one-solutions')
        ? jQuery('.headers .header.all-in-one-solutions, .body .body-item.all-in-one-solutions').addClass('selected')
        : jQuery('.headers .header.payment-gateways, .body .body-item.payment-gateways').addClass('selected');

      jQuery('.ui-widget-overlay').css('height', jQuery(document).height());
    });

  }
);

// Autoloading new POPUP widget
core.autoload(PopupButtonAddPaymentMethod);
