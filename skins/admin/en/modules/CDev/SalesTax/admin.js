/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Taxes controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function() {

    jQuery('.edit-sales-tax table.form button.switch-state')
      .removeAttr('onclick')
      .click(
      function() {
        var o = this;
        o.disabled = true;
        core.post(
          URLHandler.buildURL({target: 'sales_tax', action: 'switch'}),
          function(XMLHttpRequest, textStatus, data, valid) {
            o.disabled = false;
            if (valid) {
              var td = jQuery('.edit-sales-tax table.form td.button');
              if (td.hasClass('enabled')) {
                td.removeClass('enabled');
                td.addClass('disabled');
              
              } else {
                td.removeClass('disabled');
                td.addClass('enabled');
              }
            }
          }
        );

        return false;
      }
    );
  }
);
