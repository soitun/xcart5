/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Add address button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonAddAddress()
{
  PopupButtonAddAddress.superclass.constructor.apply(this, arguments);
}

extend(PopupButtonAddAddress, PopupButton);

PopupButtonAddAddress.prototype.pattern = '.add-address';

PopupButtonAddAddress.prototype.callback = function(selector)
{
  PopupButton.prototype.callback.apply(this, arguments);

  // Some autoloading could be added
  UpdateStatesList();
}

core.autoload(PopupButtonAddAddress);
