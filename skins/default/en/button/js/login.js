/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Add address button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonLogin(base)
{
  PopupButtonLogin.superclass.constructor.apply(this, arguments);
}

extend(PopupButtonLogin, PopupButton);

PopupButtonLogin.prototype.pattern = '.popup-button.popup-login';

decorate(
  'PopupButtonLogin',
  'callback',
  function (selector)
  {
    // Some autoloading could be added
  }
);

decorate(
  'PopupButtonLogin',
  'getURLParams',
  function ()
  {
    var params = arguments.callee.previousMethod.apply(this, arguments);
    params.popup = 1;

    return params;
  }
);

core.autoload(PopupButtonLogin);
