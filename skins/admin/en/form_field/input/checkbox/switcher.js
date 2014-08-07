/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Switcher controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

CommonForm.elementControllers.push(
  {
    pattern: '.line .input-field-wrapper.switcher.switcher-read-write',
    handler: function () {
      var input = jQuery(':checkbox', this);
      var cnt = jQuery(this);
      var widget = jQuery('.widget', this);

      widget.click(
        function () {
          if (!input.prop('disabled')) {
            input.click();

            input.change();
          }
        }
      );

      input.change(
        function () {
          if (this.checked) {
            cnt.addClass('enabled').removeClass('disabled');
            widget.attr('title', widget.data('disable-label'));

          } else {
            cnt.removeClass('enabled').addClass('disabled');
            widget.attr('title', widget.data('enable-label'));
          }
        }
      );
    }
  }
);
