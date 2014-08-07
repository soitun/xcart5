/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Main controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery(document).ready(
  function () {
    jQuery('select#access-level').change(
      function() {
        if (100 <= jQuery(this).val()) {
          jQuery('.select-checkboxlist-roles').show();

        } else {
          jQuery('.select-checkboxlist-roles').hide();
        }
      }
    );
    jQuery('select#access-level').change();
  }
);
