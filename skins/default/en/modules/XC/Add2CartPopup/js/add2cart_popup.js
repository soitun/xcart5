/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * JS controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

var showAdd2CartPopup = true;

function PopupButtonAdd2CartPopup()
{
  core.bind(
    'addToCartViaDrop',
    function(event, data) {
      if (!core.getCommentedData(jQuery('body'), 'a2cp_enable_for_dropping')) {
        showAdd2CartPopup = data.widget && data.widget.base.eq(0).hasClass('add-to-cart-popup');
      }
    }
  );
  core.bind('updateCart', this.handleOpenPopup);
  core.bind(
    'afterPopupPlace',
    function() {
      core.autoload(ProductsListController);
    }
  );

  PopupButtonAdd2CartPopup.superclass.constructor.apply(this, arguments);
}

// Extend AController
extend(PopupButtonAdd2CartPopup, AController);

PopupButtonAdd2CartPopup.prototype.popupResult = null;

// Re-initialize products list controller
PopupButtonAdd2CartPopup.prototype.handleOpenPopup = function(event)
{
  if (!showAdd2CartPopup) {
    showAdd2CartPopup = true;
    return;
  }

  setTimeout(
    function()
    {
      this.popupResult = !popup.load(
        URLHandler.buildURL({ target: 'add2_cart_popup' }),
        {
          dialogClass: 'add2cartpopup'
        }
      );
    },
    1
  );

  return this.popupResult;
};

// Autoloading new POPUP widget
core.autoload(PopupButtonAdd2CartPopup);
