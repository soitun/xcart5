/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Core version selector controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonUpgradeWidget()
{
  PopupButtonUpgradeWidget.superclass.constructor.apply(this, arguments);

  // Remove redirection to HREF. (top link menu)
  jQuery('a' + this.pattern).attr('href', 'javascript:void(0);');
}

extend(PopupButtonUpgradeWidget, PopupButton);

PopupButtonUpgradeWidget.prototype.pattern = '.upgrade-popup-widget';

PopupButtonUpgradeWidget.prototype.options = {
  'width'       : 'auto',
  'dialogClass' : 'popup upgrade-popup-block'
};

core.autoload(PopupButtonUpgradeWidget);
