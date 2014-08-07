/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Modify user button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonModifyAddress()
{
  PopupButtonModifyAddress.superclass.constructor.apply(this, arguments);
}

extend(PopupButtonModifyAddress, PopupButton);

PopupButtonModifyAddress.prototype.pattern = '.modify-address';

decorate(
  'PopupButtonModifyAddress',
  'callback',
  function (selector)
  {
    // Some autoloading could be added
    UpdateStatesList();
  }
);

core.autoload(PopupButtonModifyAddress);
