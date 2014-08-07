/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * UPS configuration page js-controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery(document).ready(function(){

  jQuery("#ups-extra-cover").click(function() {
    if (jQuery("#ups-extra-cover:checked").length) {
      jQuery("#ups-extra-cover-value").show();
    } else {
      jQuery("#ups-extra-cover-value").hide();
    }
  });

});

