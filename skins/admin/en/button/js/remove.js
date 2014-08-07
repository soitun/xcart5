/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Remove button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

CommonForm.elementControllers.push(
  {
    pattern: '.line .actions .remove-wrapper',
    handler: function () {
      var inp = jQuery('input', this).eq(0);
      var btn = jQuery('button.remove', this);
      var cell = btn.parents('.line').eq(0);

      btn.click(
        function () {
          inp.click();
        }
      );

      inp.change(
        function () {
          if (inp.is(':checked')) {
            btn.addClass('mark');
            cell.addClass('remove-mark');

          } else {
            btn.removeClass('mark');
            cell.removeClass('remove-mark');
          }

          cell.parents('form').change();
        }
      );
    }
  }
);
