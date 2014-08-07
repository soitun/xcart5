/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Browser server button and popup controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonEnterLicenseKey()
{
  PopupButtonEnterLicenseKey.superclass.constructor.apply(this, arguments);
}

// New POPUP button widget extends POPUP button class
extend(PopupButtonEnterLicenseKey, PopupButton);

// New pattern is defined
PopupButtonEnterLicenseKey.prototype.pattern = '.enter-license-key';

PopupButtonEnterLicenseKey.prototype.enableBackgroundSubmit = false;

// Autoloading new POPUP widget
core.autoload(PopupButtonEnterLicenseKey);
