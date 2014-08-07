/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Import / import controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function() {
    jQuery('.import-progress .bar')
      .bind(
        'changePercent',
        function(event, data) {
          if (data) {
            if ('undefined' != typeof(data.rowsProcessedLabel)) {
              jQuery('.import-progress .rows-processed').html(data.rowsProcessedLabel);
            }
          }
        }
      )
      .bind(
        'error',
        function() {
          this.errorState = true;
          self.location = URLHandler.buildURL({ 'target': 'import', 'failed': 1 });
        }
      )
      .bind(
        'complete',
        function() {
          if (!this.errorState) {
            self.location = URLHandler.buildURL({ 'target': 'import', 'completed': 1 });
          }
        }
      );

    jQuery('#files').live(
      'change',
      function() {
        if (jQuery('#files').val()) {
          jQuery('.import-box .submit').removeClass('disabled');
        } else {
          jQuery('.import-box .submit').addClass('disabled');
        }
      }
    );

    jQuery('.import-box.import-begin form').submit(
      function() {
        if (!jQuery('#files').val()) {
          return false;
        }
      }
    );
  }
);
