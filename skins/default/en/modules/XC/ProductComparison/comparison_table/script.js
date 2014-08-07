/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Product comparison table
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */


jQuery(document).ready(
  function() {
    jQuery('button.add2cart').click(
      function() {
        // Form AJAX-based submit
        var form = this.form;

        if (form) {
          form.commonController.submitBackground()
        }
      }
    );

    jQuery('table.comparison-table tbody.data tr').not('.group').each(
      function() {
        var tr = jQuery(this);
        var td = false;
        var ident = true;
        tr.find('td').not(':first-child').each(
          function() {
            if (false === td) {
              td = jQuery(this).html();
            } else if (td != jQuery(this).html()) {
              ident = false;
            }
          }
        );
        if (ident) {
          tr.addClass('hidden');
        }
      }
    );

    jQuery('table.comparison-table tbody.data tr.group').each(
      function() {
        var tr = jQuery(this);
        var hide = true;
        tr.nextUntil('tr.group').each(
          function() {
            if (!jQuery(this).hasClass('hidden')) {
              hide = false;
            }
          }
        );
        if (hide) {
          tr.addClass('hidden');
        }
      }
    );

    tData = jQuery('table.comparison-table tbody.data');
    tData.addClass('diff-only');
    jQuery('input#diff').change(
      function() {
        if (jQuery(this).prop('checked')) {
          tData.addClass('diff-only');
        } else {
          tData.removeClass('diff-only');
        }
      }
    ).prop('checked', 'checked');

    jQuery('span.three-dots').mouseenter(
      function() {
        var sp = jQuery(this);
        jQuery(this).find('div').each(
          function() {
            jQuery(this).css('position', 'fixed');
            jQuery(this).css('top', sp.offset().top - jQuery(window).scrollTop() + 12);
            jQuery(this).css('left', sp.offset().left - jQuery(window).scrollLeft() + 27);
          }
        );
      }
    );

    var headerFixed = jQuery('table.comparison-table tbody.header-fixed');
    var header = jQuery('table.comparison-table tbody.header');

    var width = 960 / Math.min(5, jQuery('table.comparison-table tbody.header-hidden').find('td').length) - 24;
    jQuery('table.comparison-table td').width(width);
    jQuery('table.comparison-table tr.names td div').width(width - 1);

    var headerFixedTop = headerFixed.offset().top;
    var headerHeight = header.height();
    jQuery('table.comparison-table tbody.header-hidden').show();
    headerFixed.addClass('fixed');
    jQuery(window).scroll(
      function() {
        var top = jQuery(this).scrollTop() - headerFixedTop - 1;
        headerFixed.css('top', (0 < top ? top: 0) + headerHeight);
        if (top > -4) {
          headerFixed.addClass('scrolled');
        } else {
          headerFixed.removeClass('scrolled');
        }
      }
    );
    jQuery(window).scroll();
  }
);
