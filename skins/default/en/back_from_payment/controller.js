/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Back from payment controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

/**
 * Main widget
 */

decorate(
  'CheckoutView',
  'postprocess',
  function(isSuccess, initial)
  {
    arguments.callee.previousMethod.apply(this, arguments);

    if (isSuccess) {
      popup.load(URLHandler.buildURL({ 'target': 'back_from_payment'}));
    }
  }
);

