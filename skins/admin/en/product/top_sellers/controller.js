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
    jQuery('.top-sellers .period-box .field select', this.base).change(
      function () {

        var id = jQuery('.top-sellers .period-box .field select option:selected').val();

        var box = jQuery(this).parents('.top-sellers');
        box.find('.block-container').hide();
        box.find('#period-' + id).show();

        return true;
      }
    );
  }
);
