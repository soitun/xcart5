/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Product class
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function () {
    jQuery('div.product-class-text button').click(
      function () {
        jQuery('div.product-class-text').hide();
        jQuery('div.product-class-select').attr('style', 'display:table');
        return false;
      }
    );

    jQuery('div.product-class-select select').change(
      function () {
        if (jQuery(this).val() == -1) {
            jQuery('div.product-class-select input').show();
        } else {
            jQuery('div.product-class-select input').hide();
        }
      }
    );
  }
);
