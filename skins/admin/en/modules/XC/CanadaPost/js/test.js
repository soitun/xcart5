/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Canada Post test
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

(function ($, window, undefined) {

  $(function () {
    
    $('#destination-country').bind('change', function () {

      $('#destination-postal-code').closest('li')
        .toggle('US' == $(this).val() || 'CA' == $(this).val());

    }).trigger('change');

    $.validationEngineLanguage.allRules.canadianPostalCode = {
      "regex": /^[ABCEGHJKLMNPRSTVXY]\d[A-Z] ?\d[A-Z]\d$/,
      "alertText": "* Invalid Canadian Post Code"
    };

  });

})(jQuery, window);
