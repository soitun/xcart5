/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * AustraliaPost configuration page js-controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery(document).ready(function(){

  jQuery("#aus-test-mode").click(function() {
    if (jQuery("#aus-test-mode:checked").length) {
      jQuery("#aus-api-key").hide();
    } else {
      jQuery("#aus-api-key").show();
    }
  });

  jQuery("#aus-package-box-type").change(function() {
    if (jQuery("#aus-package-box-type :selected").val() == 'AUS_PARCEL_TYPE_BOXED_OTH') {
      jQuery("#aus-own-package-size").show();
    } else {
      jQuery("#aus-own-package-size").hide();
    }
  });

  jQuery("#aus-extra-cover").click(function() {
    if (jQuery("#aus-extra-cover:checked").length) {
      jQuery("#aus-extra-cover-value").show();
    } else {
      jQuery("#aus-extra-cover-value").hide();
    }
  });

});

