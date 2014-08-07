/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Products list controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function PinCodesListView(base) {
  PinCodesListView.superclass.constructor.apply(this, arguments);
}

extend(PinCodesListView, ListView);

// PinCodes list class
function PinCodesListController(base) {
  PinCodesListController.superclass.constructor.apply(this, arguments);
}

extend(PinCodesListController, ListsController);

PinCodesListController.prototype.name = 'PinCodesListController';

PinCodesListController.prototype.getListView = function() {
  return new PinCodesListView(this.base);
}
core.autoload(PinCodesListController);


