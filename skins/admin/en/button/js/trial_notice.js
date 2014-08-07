/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Trial notice button and popup controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonTrialNotice()
{
  PopupButtonTrialNotice.superclass.constructor.apply(this, arguments);
}

// New POPUP button widget extends POPUP button class
extend(PopupButtonTrialNotice, PopupButton);

// New pattern is defined
PopupButtonTrialNotice.prototype.pattern = '.force-notice';

PopupButtonTrialNotice.prototype.enableBackgroundSubmit = false;

decorate(
  'PopupButtonTrialNotice',
  'callback',
  function(selector) {
    core.autoload(PopupButtonActivateKey);
  }
);

// Autoloading new POPUP widget
core.autoload(PopupButtonTrialNotice);

// Auto display popup window
jQuery(document).ready(function () {
  if (jQuery(PopupButtonTrialNotice.prototype.pattern))
    jQuery(PopupButtonTrialNotice.prototype.pattern).click();
})

