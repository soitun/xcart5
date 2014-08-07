/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Shipments page controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

(function ($, window, undefined) {

  $(function () {

    $('.ca-package').each(function () {

      var obj = $(this);

      var parcelStatus = core.getCommentedData(obj, 'status');

      if (parcelStatus != 'P') {
        // Block options
        $('select,input,textarea', obj).prop('disabled', 'disabled');
      }

    });

    var base = $('.shipment-info .shipment-info-part');

    $('a.tracking-details-link', base).click(
      function () {
        return !popup.load(
          this,
          null,
          false
        );
      }
    );

  });

})(jQuery, window);
