/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Orders search form controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery(document).ready(
  function() {

    // Add search form visibility switcher
    jQuery('a.search-orders').click(
      function() {
        var elm = jQuery('form.search-orders');
        if (elm.css('display') == 'none') {
          jQuery(this).addClass('dynamic-open').removeClass('dynamic-close');
          elm.show();

        } else {
          jQuery(this).addClass('dynamic-close').removeClass('dynamic-open');
          elm.hide();
        }

        return false;
      }
    );

    // Reset form
    jQuery('form.search-orders .reset a').click(
      function() {

        var form = jQuery(this).parents('form').eq(0);
        jQuery('input:text', form).val('');
        jQuery('select[name="status"]', form).val('');

        form.trigger('customReset');

        form.submit();

        return false;
      }
    );
  }
);
