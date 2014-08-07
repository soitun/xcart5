/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Controller-decorator for Selection installation type button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonSelectInstallationType()
{
  PopupButtonSelectInstallationType.superclass.constructor.apply(this, arguments);
}

extend(PopupButtonSelectInstallationType, PopupButton);

PopupButtonSelectInstallationType.prototype.pattern = '.select-installation-type-button';

decorate(
  'PopupButtonSelectInstallationType',
  'callback',
  function (selector)
  {
    // Autoloading of switch button and license agreement widgets.
    // They are shown in License agreement popup window.
    // TODO. make it dynamically and move it to ONE widget initialization (Main widget)

  }
);

core.autoload(PopupButtonSelectInstallationType);
