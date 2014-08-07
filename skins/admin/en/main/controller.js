/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Admin Welcome block js-controller
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

    // Close 'Welcome...' block
    jQuery('.admin-welcome .welcome-footer .close-button', this.base).click(
      function () {

        var ch = jQuery('#doNotShowAtStartup:checked').length;

        var action = 'hide_welcome_block';

        if (ch) {
          action = 'hide_welcome_block_forever';
        }

        jQuery.ajax({
          url: xliteConfig.script + "?target=main&action=" + action + '&' + core.getFormIdString(),
        }).done(function() { 
        });

        jQuery('.admin-welcome').hide();
        jQuery('.admin-welcome-indent').removeClass('admin-welcome-indent');
      }
    );
  }
);
