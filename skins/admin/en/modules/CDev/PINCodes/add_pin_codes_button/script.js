/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Add PIN codes button and popup controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PopupButtonAddPinCodesButton() {
  PopupButtonAddPinCodesButton.superclass.constructor.apply(this, arguments);
}

extend(PopupButtonAddPinCodesButton, PopupButton);

PopupButtonAddPinCodesButton.prototype.pattern = '.add-pin-codes-button';

decorate(
  'PopupButtonAddPinCodesButton',
  'afterSubmit',
  function (selector) {
    jQuery('.items-list')[0].itemsListController.loadWidget();
  }
);

decorate(
  'PopupButtonAddPinCodesButton',
  'eachClick',
  function (elem) {

    if (elem.linkedDialog) {
      jQuery(elem.linkedDialog).dialog('close').remove();
      elem.linkedDialog = undefined;
    }

    return arguments.callee.previousMethod.apply(this, arguments);
  }
);

core.autoload(PopupButtonAddPinCodesButton);
