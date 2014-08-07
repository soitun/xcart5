/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * List controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery(document).ready(
  function () {

    // Tooltips
    jQuery('.methods li .warning img,.methods li .test-mode img').each(
      function () {
        if (this.alt) {
          attachTooltip(jQuery(this), this.alt);
        }
      }
    );

    jQuery('.methods li.blocked-switch .switch').each(
      function () {
        if (this.title) {
          attachTooltip(jQuery(this), this.title);
          this.title = '';
        }
      }
    );

  }
);
