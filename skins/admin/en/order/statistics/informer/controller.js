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
    jQuery('.js-tabs.order-stats-informer-tabs .tabs li span', this.base).click(
      function () {
        if (!jQuery(this).parent().hasClass('active')) {

          var id = this.id.substr(5);

          jQuery(this).parents('ul').eq(0).find('li.active').removeClass('active');
          jQuery(this).parent().addClass('active');

          var box = jQuery(this).parents('.js-tabs.order-stats-informer-tabs');
          box.find('.tab-container').hide();
          box.find('#' + id).show();
        }

        return true;
      }
    );
  }
);
