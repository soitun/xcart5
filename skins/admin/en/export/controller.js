/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Import / export controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function() {
    jQuery('.export-progress .bar')
      .bind(
        'changePercent',
        function(event, data) {
          if (data && 'undefined' != typeof(data.timeLabel)) {
            jQuery('.export-progress .time').html(data.timeLabel);
          }
        }
      )
      .bind(
        'error',
        function() {
          this.errorState = true;
          self.location = URLHandler.buildURL({ 'target': 'export', 'failed': 1 });
        }
      )
      .bind(
        'complete',
        function() {
          if (!this.errorState) {
            self.location = URLHandler.buildURL({ 'target': 'export', 'completed': 1 });
          }
        }
      );

    var height = 0;
    jQuery('.export-completed .files.std ul li.file').each(
      function () {
        height += jQuery(this).outerHeight();
      }
    );

    var bracket = jQuery('.export-completed .files ul li.sum .bracket');
    var diff = bracket.outerHeight() - bracket.innerHeight();

    bracket.height(height - diff);

    jQuery('.sections input').change(
      function() {
        if (jQuery('.sections input:checked').not(':disabled').length) {
          jQuery('.export-box .submit').removeClass('disabled');

        } else {
          jQuery('.export-box .submit').addClass('disabled');
        }

        if (jQuery('.sections input#sectionXLiteLogicExportStepProducts:checked').not(':disabled').length) {
          jQuery('.options .attrs-option').show();

        } else {
          jQuery('.options .attrs-option').hide();
        }

      }
    );

    jQuery('.export-box.export-begin form').submit(
      function() {
        if (!jQuery('.sections input:checked').not(':disabled').length) {
          return false;
        }
      }
    );
  }
);
