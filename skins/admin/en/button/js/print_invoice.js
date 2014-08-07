/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Print invoice button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

// This function opens popup window 'Print invoice' and print its content
function openPrintInvoiceWindow (params, elem) {

  var url = URLHandler.buildURL(params);

  jQuery(elem).addClass('suspended');

  if (jQuery('#iframe-invoice').length) {
    jQuery('#iframe-invoice').remove();
  }
  jQuery("<iframe id='iframe-invoice' name='invoice' style='height: 0px; width: 0px;' src='" + url + "' />").appendTo('body');
  jQuery('#iframe-invoice').load(
    function() {
      jQuery(elem).removeClass('suspended');
      window.frames['invoice'].focus();
      window.frames['invoice'].print();
    }
  );
}

jQuery().ready(
  function () {

    // Process click event on 'Print invoice' button on order details page
    jQuery('button.print-invoice').click(
      function () {
        var elem = this;
        openPrintInvoiceWindow(core.getCommentedData(elem, 'url_params'), elem);
      }
    );

    // Process click event on 'Print selected' button on orders list page
    jQuery('button.print-invoices').click(
      function() {

        if (jQuery(this).hasClass('disabled')) {
          return;
        }

        var elem = this;

        var params = core.getCommentedData(elem, 'url_params');

        var selectors = jQuery('.items-list.orders table.list .selector.checked input[type="checkbox"].selector');

        for (var i = 0; i < selectors.length; i++) {

          var prefix = '';

          if (params['order_ids']) {
            prefix = ',';
          }

          params['order_ids'] = params['order_ids'] + prefix + selectors[i].name.replace(/select\[(\d+)\]/, '$1');
        }

        openPrintInvoiceWindow(params, elem);
      }
    );
  }
);
