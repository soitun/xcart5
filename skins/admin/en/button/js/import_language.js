/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Import language button and popup controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonImportLanguage()
{
  PopupButtonImportLanguage.superclass.constructor.apply(this, arguments);
}

// New POPUP button widget extends POPUP button class
extend(PopupButtonImportLanguage, PopupButton);

// New pattern is defined
PopupButtonImportLanguage.prototype.pattern = '.force-import-language';

PopupButtonImportLanguage.prototype.enableBackgroundSubmit = false;

// Autoloading new POPUP widget
core.autoload(PopupButtonImportLanguage);

// Auto display popup window
jQuery(document).ready(function () {
  if (jQuery(PopupButtonImportLanguage.prototype.pattern))
    jQuery(PopupButtonImportLanguage.prototype.pattern).click();
})
