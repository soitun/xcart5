/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Product details controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

/**
 * Controller
 */

jQuery().ready(
  function() {

    // Tabs
    jQuery('#shippable').change(
      function () {

        if ('Y' == jQuery('#shippable option:selected').val()) {
          jQuery('.select-product-useseparatebox').show();
        } else {
          jQuery('.select-product-useseparatebox').hide();
        }

        return true;
      }
    );

    // Tabs
    jQuery('#useseparatebox').change(
      function () {

        if ('Y' == jQuery('#useseparatebox option:selected').val()) {
          jQuery('#block-use-separate-box').show();
        } else {
          jQuery('#block-use-separate-box').hide();
        }

        return true;
      }
    );

    jQuery('#shippable, #useseparatebox').change();
  }
);
