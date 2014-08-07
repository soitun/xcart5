/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Order statuses selector controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery(document).ready(
  function() {
    // Open warning popup
    core.microhandlers.add(
      'openWarningPopupByLink',
      'a.popup-warning',
      function() {
        if (0 < jQuery(this).next('div.status-warning-content').length) {
          attachTooltip(this, jQuery(this).next('div.status-warning-content').html());
        }
      }
    );
  }
);
