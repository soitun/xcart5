/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Language labels items list javascript controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

ItemsList.prototype.listeners.labels = function(handler)
{
    // Rollover
    jQuery('.label-name').click(
      function () {
        var main = jQuery(this).parents('.language-labels').eq(0);
        var info = main.find('.label-edit');
        var icon = jQuery(this).find('.open-edit-box').eq(0);
        if (0 < info.filter(':visible').length) {
          info.hide();
          jQuery(icon).removeClass('expanded');

        } else {
          info.show();
          jQuery(icon).addClass('expanded');
        }

        return false;
      }
    );
}
