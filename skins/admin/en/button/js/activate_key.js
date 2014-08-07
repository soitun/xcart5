/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Activate license key button and popup controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonActivateKey()
{
  PopupButtonActivateKey.superclass.constructor.apply(this, arguments);
}

// New POPUP button widget extends POPUP button class
extend(PopupButtonActivateKey, PopupButton);

// New pattern is defined
PopupButtonActivateKey.prototype.pattern = '.activate-key';

PopupButtonActivateKey.prototype.enableBackgroundSubmit = false;

PopupButtonActivateKey.prototype.callback = function (selector, link)
{
  PopupButton.prototype.callback.apply(this, arguments);
  jQuery('form', selector).each(
    function() {
      this.commonController.backgroundSubmit = false;
    }
  );
}

// Autoloading new POPUP widget
core.autoload(PopupButtonActivateKey);

core.microhandlers.add(
  'PopupButtonActivateKey',
  PopupButtonActivateKey.prototype.pattern,
  function (event) {
    core.autoload(PopupButtonActivateKey);
  }
);
