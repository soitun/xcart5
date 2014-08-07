/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Date picker controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */
function datePickerPostprocess(input, elm)
{
}

jQuery().ready(
  function() {
    jQuery('.date-picker-widget').each(
      function () {
        var elem = jQuery(this);
        var options = core.getCommentedData(elem);

        jQuery(elem).find('input').datepicker({
          dateFormat:        options.dateFormat,
          gotoCurrent:       true,
          yearRange:         options.highYear + ':' + options.lowYear,
          showButtonPanel:   false,
          beforeShow:        datePickerPostprocess,
          selectOtherMonths: true
        });
    });
  }
);
