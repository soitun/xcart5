/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Coupon page controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function () {
    jQuery('.coupons .uses-limit-check input[type="checkbox"]').change(
      function () {
        var box = jQuery('.coupons .uses-limit');
        if (this.checked) {
          box.addClass('enabled');

        } else {
          box.removeClass('enabled');
        }
      }
    ).change();
  }
);

