/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Popup open button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

var lastPopupButton;

function PopupButton(base)
{
  var obj = this;

  if (base) {
    this.eachCallback(base);
  } else {
    jQuery(this.pattern).each(
      function () {
        obj.eachCallback(this);
      }
    );
  }
}

PopupButton.prototype.pattern = '.popup-button';

PopupButton.prototype.enableBackgroundSubmit = true;

PopupButton.prototype.options = {
  width: 'auto'
};

PopupButton.prototype.afterSubmit = function (selector) {
};

PopupButton.prototype.callback = function (selector, link)
{
  var obj = this;

  if (this.enableBackgroundSubmit) {
    jQuery('form', selector).each(
      function() {
        jQuery(this).commonController(
          'enableBackgroundSubmit',
          function () {
            // Close dialog (but it is available in DOM)
            popup.close();
            openWaitBar();

            return true;
          },
          function (event) {
            closeWaitBar();

            obj.afterSubmit(selector);

            // Remove dialog from DOM
            jQuery(selector).remove();

            return false;
          }
        );
      }
    );

  } else {
    jQuery('form', selector).each(
      function() {
        this.commonController.backgroundSubmit = false;
      }
    );
  }
};

PopupButton.prototype.getURLParams = function (button)
{
  return core.getCommentedData(button, 'url_params');
};

PopupButton.prototype.eachClick = function (elem)
{
  lastPopupButton = jQuery(elem);

  return lastPopupButton.hasClass('disabled')
    ? false
    : loadDialogByLink(
      elem,
      URLHandler.buildURL(this.getURLParams(elem)),
      this.options,
      this.callback,
      this
    );
};

PopupButton.prototype.eachCallback = function (elem)
{
  var obj = this;

  jQuery(elem).click(
    function(event) {
      obj.eachClick(this);
      event.stopImmediatePropagation();

      return false;
    }
  );
};
